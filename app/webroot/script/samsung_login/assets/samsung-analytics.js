/**
 * Read cookie
 * @param name
 * @returns
 */
function readCookie(name) {
  var nameEQ = name + "=";
  var ca = document.cookie.split(';');
  for (var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) === ' ') c = c.substring(1, c.length);
    if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
  }
  return null;
}

/**
 * Write cookie
 * @param name
 * @param value
 */
function writeCookie(name, value) {
  document.cookie = name + "=" + value + "; path=/";
}

function generateRandomString() {
  const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
  let result = '';
  const charactersLength = characters.length;
  for (let i = 0; i < 32; i++) {
    result += characters.charAt(Math.floor(Math.random() * charactersLength));
  }
  return result;
}

function analytics_init(tid, av, uv, hc, testbed) {
  if (tid === undefined) {
    console.error('no tid');
    return;
  }
  if (hc === undefined) {
    console.error('no hc');
    return;
  }
  if (av === undefined) {
    console.error('no av')
    return;
  }
  if (uv === undefined) {
    console.error('no uv')
    return;
  }

  let sa_did = readCookie('sa_did');
  if (sa_did === null) {
    sa_did = generateRandomString();
    writeCookie('sa_did', sa_did);
  }

  let analytics;
  analytics = {};
  analytics.tid = tid;
  analytics.av = av;
  analytics.uv = uv;
  analytics.hc = hc;
  analytics.auid = sa_did;
  analytics.testbed = testbed;
  window.analytics = analytics;
}

function encodeAsciiAsArray(data) {
  let encoded = new TextEncoder().encode(data);
  let array = [];
  for (let i = 0; i < encoded.length; i++) {
    array.push(encoded[i]);
  }
  return array;
}

function addItemWithEnd(rawArray, key, value) {
  rawArray = addItem(rawArray, key, value);
  rawArray.push(02);
  return rawArray;
}

function addItem(rawArray, key, value) {
  rawArray = rawArray.concat(encodeAsciiAsArray(key));
  rawArray.push(03);
  rawArray = rawArray.concat(encodeAsciiAsArray(value));
  return rawArray;
}

function analytics_send(en, pn, cd, success, failure) {
  if (window.analytics === undefined) {
    console.error("not initialized yet");
    return;
  }

  if (pn === undefined) {
    console.error("no pn");
    return;
  }

  const analytics = window.analytics;
  const today = new Date();
  const time = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate() + "T"
    + today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
  let tz = Math.abs(today.getTimezoneOffset());

  let rawArray = [];
  rawArray = addItemWithEnd(rawArray, 'auid', analytics.auid)
  rawArray = addItemWithEnd(rawArray, 'tz', tz)
  rawArray = addItemWithEnd(rawArray, 'dm', 'web')
  rawArray = addItemWithEnd(rawArray, 'do', '1.0')
  rawArray = addItemWithEnd(rawArray, 'tid', analytics.tid)
  rawArray = addItemWithEnd(rawArray, 'et', 0)
  rawArray = addItemWithEnd(rawArray, 'fv', 'web')
  rawArray = addItemWithEnd(rawArray, 'at', '2')
  rawArray = addItemWithEnd(rawArray, 'la', window.navigator.language.substr(0, 2))
  rawArray = addItemWithEnd(rawArray, 'av', analytics.av)
  rawArray = addItemWithEnd(rawArray, 'pn', pn)
  rawArray = addItemWithEnd(rawArray, 'ts', Date.now())
  rawArray = addItemWithEnd(rawArray, 'uv', analytics.uv)

  let customDimension;
  const keys = Object.keys(cd);

  for (let i = 0; i < keys.length; i++) {
    const key = keys[i];
    const value = cd[key];
    if (customDimension) {
      customDimension = customDimension + '\u0004' + key + '\u0005' + value
    } else {
      customDimension = key + '\u0005' + value
    }
  }
  rawArray = addItemWithEnd(rawArray, 'cd', customDimension)

  if (en !== undefined) {
    rawArray = addItemWithEnd(rawArray, 'en', en)
    rawArray = addItemWithEnd(rawArray, 't', 'ev')
  } else {
    rawArray = addItemWithEnd(rawArray, 't', 'pv')
  }

  if (window.analytics.testbed === true) {
    console.log(rawArray);
  }

  let eventData = new Uint8Array(rawArray);
  const xhr = new XMLHttpRequest();
  let endpoint = 'https://dls-account.di.atlas.samsung.com/dls2/dtransf';
  if (window.analytics.testbed === true) {
    endpoint = 'https://dlstb-account.di.atlas.samsung.com/dls2/dtransf';
    endpoint = 'https://dlstb.di.atlas.samsung.com/dls2/dtransf';
  }
  xhr.open('POST', endpoint + '/wl?tid=' + analytics.tid
    + '&ts=' + time
    + '&uv=' + analytics.uv
    + '&hc=' + analytics.hc, true);

  xhr.timeout = 3000;
  xhr.withCredentials = false;
  xhr.setRequestHeader('Content-type', 'text/plain');
  xhr.setRequestHeader('Content-Encoding', 'text');

  xhr.onload = function (e) {
    if (xhr.readyState === 4) {
      if (xhr.status === 200) {
        if (success !== undefined && typeof success === 'function') {
          success()
        }
      } else {
        console.error(xhr.responseText);
        if (failure !== undefined && typeof failure === 'function') {
          failure()
        }
      }
    }
  };

  xhr.onerror = function (e) {
    console.error(xhr.statusText);
    if (failure !== undefined && typeof failure === 'function') {
      failure()
    }
  };

  xhr.ontimeout = function() {
    console.error(xhr.statusText);
    if (failure !== undefined && typeof failure === 'function') {
      failure()
    }
  }

  xhr.send(eventData);
  if (window.analytics.testbed === true) {
    console.log(new TextDecoder().decode(eventData));
  }
}
