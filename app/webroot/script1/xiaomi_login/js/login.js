(function() {
    function j(p, o) {
        var r;
        if (p) {
            for (var n, h = o ? 1 : 0; n = f[h++];) {
                if (r = b[n]) {
                    for (var q, m = 0;
                        (q = r[m]) && !0 !== p(n, q); m++) {}
                }
            }
        }
    }

    function l(h) {
        var d;
        j(function(m, c) {
            if ((h + "").toUpperCase() === c.B) {
                return d = d || c, !0
            }
        });
        return d
    }

    function e(h) {
        var d;
        j(function(n, m) {
            h = (h + "").replace(/^0+/, "").replace(/^\+/, "");
            var c = (m.N + "").replace(/^0+/, "").replace(/^\+/, "");
            h === c && (d = m)
        });
        return d
    }

    function g(h) {
        var d;
        j(function(m, c) {
            if ((h + "").toLowerCase() === c.C.toLowerCase()) {
                return d = c, !0
            }
        });
        return d
    }

    function k(c) {
        return l(c) || e(c) || g(c)
    }
    var f = "ABCDEFGHIJKLMNOPQRSTUVWXYZ".split(""),
        b = {};
    if (JSP_VAR) {
        var b = JSP_VAR.areaConfig,
            i = JSP_VAR.locale;
        0 === i.indexOf("zh") && (i = "zh_CN" === i ? "zh_CN" : "zh_TW")
    }
    window.RegionsCode = {
        getAll: function(r, q, o) {
            for (var v = ["<div class='country-code'>"], t, p, u, m = 0; p = f[m++];) {
                if (t = b[p], u = "", r && p in r && (u = r[p]), t) {
                    v.push("<div class='container countrycode-container-" + p + "'><div class='header'>" + (u || p) + "</div>");
                    v.push("<ul class='list'>");
                    for (var n = 0; u = t[n++];) {
                        p = q ? (u.N + "").replace(/^0+/, function() {
                            return "+"
                        }) : "", v.push("<li class='record clearfix'><span class='record-country' data-code='" + p + "' data-brief='" + u.B + "'>" + u.C + "</span><span class='record-code'>" + p + "</span></li>")
                    }
                    v.push("</ul></div>")
                }
            }
            r = cancelStr = "";
            cancelStr = JSP_VAR && JSP_VAR.cancel ? JSP_VAR.cancel : "Cancel";
            o ? r = "" : r = '<div class="cancel_panel"><div class="cancel_box"><a class="btnadpt bg_white btn-cancel" href="javascript:void(0);">' + cancelStr + "</a></div></div>";
            v.push("</div>");
            v.push(r);
            v.push('<div class="navbar_panel"><div class="navbar"><a to="usual">#</a>');
            for (o = 0; 26 > o; o++) {
                r = String.fromCharCode(65 + o), v.push('<a to="' + r + '">' + r + "</a>")
            }
            v.push("</div></div>");
            return v.join("")
        },
        getData: function() {
            return {
                list: f,
                data: b
            }
        },
        getByBrief: l,
        getByCode: e,
        getByCountry: g,
        search: k,
        searchLike: function(n) {
            var m = [];
            if (n = (n + "").replace(/^\+/, "")) {
                var d = k(n);
                d && m.push(d);
                j(function(o, c) {
                    -1 !== c.C.toLowerCase().indexOf(n) ? m.push(c) : -1 !== (c.N + "").indexOf(n) && m.push(c)
                })
            }
            return m
        },
        searchLikeData: function(n) {
            var m = [];
            if (n = (n + "").replace(/^\+/, "")) {
                var d = k(n);
                d && m.push(d);
                j(function(o, c) {
                    RegExp("^" + n, "i").test(c.C.toLowerCase()) ? m.push(c) : RegExp("^" + n).test(c.N.replace(/^\+/, "")) && m.push(c)
                })
            }
            return m
        },
        addUsual: function(o) {
            var n;
            if (n = o.B) {
                if (n = o.C) {
                    if (n = o.N) {
                        a: if (b.usual) {
                            n = 0;
                            for (var m; m = b.usual[n++];) {
                                if (m.N === o.N || o.B === m.B) {
                                    n = !0;
                                    break a
                                }
                            }
                            n = !1
                        } else {
                            n = void 0
                        }n = !n
                    }
                }
            }
            n && b.usual && b.usual.unshift(o)
        }
    }
})();
var Base64 = function() {
        _keyStr = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
        _utf8_encode = function(f) {
            f = f.replace(/\r\n/g, "\n");
            for (var g = "", b = 0; b < f.length; b++) {
                var e = f.charCodeAt(b);
                128 > e ? g += String.fromCharCode(e) : (127 < e && 2048 > e ? g += String.fromCharCode(e >> 6 | 192) : (g += String.fromCharCode(e >> 12 | 224), g += String.fromCharCode(e >> 6 & 63 | 128)), g += String.fromCharCode(e & 63 | 128))
            }
            return g
        };
        _utf8_decode = function(f) {
            for (var g = "", b = 0, e = c1 = c2 = 0; b < f.length;) {
                e = f.charCodeAt(b), 128 > e ? (g += String.fromCharCode(e), b++) : 191 < e && 224 > e ? (c2 = f.charCodeAt(b + 1), g += String.fromCharCode((e & 31) << 6 | c2 & 63), b += 2) : (c2 = f.charCodeAt(b + 1), c3 = f.charCodeAt(b + 2), g += String.fromCharCode((e & 15) << 12 | (c2 & 63) << 6 | c3 & 63), b += 3)
            }
            return g
        };
        return {
            encode: function(g) {
                var i = "",
                    k, f, b, l, e, j, n = 0;
                for (g = _utf8_encode(g); n < g.length;) {
                    k = g.charCodeAt(n++), f = g.charCodeAt(n++), b = g.charCodeAt(n++), l = k >> 2, k = (k & 3) << 4 | f >> 4, e = (f & 15) << 2 | b >> 6, j = b & 63, isNaN(f) ? e = j = 64 : isNaN(b) && (j = 64), i = i + _keyStr.charAt(l) + _keyStr.charAt(k) + _keyStr.charAt(e) + _keyStr.charAt(j)
                }
                return i
            },
            decode: function(j) {
                var l = "",
                    e, g, k, f, b, i = 0;
                for (j = j.replace(/[^A-Za-z0-9\+\/\=]/g, ""); i < j.length;) {
                    e = _keyStr.indexOf(j.charAt(i++)), g = _keyStr.indexOf(j.charAt(i++)), f = _keyStr.indexOf(j.charAt(i++)), b = _keyStr.indexOf(j.charAt(i++)), e = e << 2 | g >> 4, g = (g & 15) << 4 | f >> 2, k = (f & 3) << 6 | b, l += String.fromCharCode(e), 64 != f && (l += String.fromCharCode(g)), 64 != b && (l += String.fromCharCode(k))
                }
                return l = _utf8_decode(l)
            }
        }
    }(),
    CryptoJS = CryptoJS || function(j, l) {
        var p = {},
            g = p.lib = {},
            b = function() {},
            q = g.Base = {
                extend: function(h) {
                    b.prototype = this;
                    var e = new b;
                    h && e.mixIn(h);
                    e.hasOwnProperty("init") || (e.init = function() {
                        e.$super.init.apply(this, arguments)
                    });
                    e.init.prototype = e;
                    e.$super = this;
                    return e
                },
                create: function() {
                    var d = this.extend();
                    d.init.apply(d, arguments);
                    return d
                },
                init: function() {},
                mixIn: function(h) {
                    for (var e in h) {
                        h.hasOwnProperty(e) && (this[e] = h[e])
                    }
                    h.hasOwnProperty("toString") && (this.toString = h.toString)
                },
                clone: function() {
                    return this.init.prototype.extend(this)
                }
            },
            f = g.WordArray = q.extend({
                init: function(e, c) {
                    e = this.words = e || [];
                    this.sigBytes = c != l ? c : 4 * e.length
                },
                toString: function(d) {
                    return (d || r).stringify(this)
                },
                concat: function(x) {
                    var w = this.words,
                        u = x.words,
                        v = this.sigBytes;
                    x = x.sigBytes;
                    this.clamp();
                    if (v % 4) {
                        for (var m = 0; m < x; m++) {
                            w[v + m >>> 2] |= (u[m >>> 2] >>> 24 - m % 4 * 8 & 255) << 24 - (v + m) % 4 * 8
                        }
                    } else {
                        if (65535 < u.length) {
                            for (m = 0; m < x; m += 4) {
                                w[v + m >>> 2] = u[m >>> 2]
                            }
                        } else {
                            w.push.apply(w, u)
                        }
                    }
                    this.sigBytes += x;
                    return this
                },
                clamp: function() {
                    var e = this.words,
                        d = this.sigBytes;
                    e[d >>> 2] &= 4294967295 << 32 - d % 4 * 8;
                    e.length = j.ceil(d / 4)
                },
                clone: function() {
                    var d = q.clone.call(this);
                    d.words = this.words.slice(0);
                    return d
                },
                random: function(m) {
                    for (var d = [], h = 0; h < m; h += 4) {
                        d.push(4294967296 * j.random() | 0)
                    }
                    return new f.init(d, m)
                }
            }),
            n = p.enc = {},
            r = n.Hex = {
                stringify: function(x) {
                    var w = x.words;
                    x = x.sigBytes;
                    for (var u = [], v = 0; v < x; v++) {
                        var m = w[v >>> 2] >>> 24 - v % 4 * 8 & 255;
                        u.push((m >>> 4).toString(16));
                        u.push((m & 15).toString(16))
                    }
                    return u.join("")
                },
                parse: function(v) {
                    for (var u = v.length, h = [], m = 0; m < u; m += 2) {
                        h[m >>> 3] |= parseInt(v.substr(m, 2), 16) << 24 - m % 8 * 4
                    }
                    return new f.init(h, u / 2)
                }
            },
            i = n.Latin1 = {
                stringify: function(v) {
                    var u = v.words;
                    v = v.sigBytes;
                    for (var h = [], m = 0; m < v; m++) {
                        h.push(String.fromCharCode(u[m >>> 2] >>> 24 - m % 4 * 8 & 255))
                    }
                    return h.join("")
                },
                parse: function(v) {
                    for (var u = v.length, h = [], m = 0; m < u; m++) {
                        h[m >>> 2] |= (v.charCodeAt(m) & 255) << 24 - m % 4 * 8
                    }
                    return new f.init(h, u)
                }
            },
            o = n.Utf8 = {
                stringify: function(h) {
                    try {
                        return decodeURIComponent(escape(i.stringify(h)))
                    } catch (e) {
                        throw Error("Malformed UTF-8 data")
                    }
                },
                parse: function(d) {
                    return i.parse(unescape(encodeURIComponent(d)))
                }
            },
            t = g.BufferedBlockAlgorithm = q.extend({
                reset: function() {
                    this._data = new f.init;
                    this._nDataBytes = 0
                },
                _append: function(d) {
                    "string" == typeof d && (d = o.parse(d));
                    this._data.concat(d);
                    this._nDataBytes += d.sigBytes
                },
                _process: function(z) {
                    var y = this._data,
                        w = y.words,
                        u = y.sigBytes,
                        m = this.blockSize,
                        x = u / (4 * m),
                        x = z ? j.ceil(x) : j.max((x | 0) - this._minBufferSize, 0);
                    z = x * m;
                    u = j.min(4 * z, u);
                    if (z) {
                        for (var d = 0; d < z; d += m) {
                            this._doProcessBlock(w, d)
                        }
                        d = w.splice(0, z);
                        y.sigBytes -= u
                    }
                    return new f.init(d, u)
                },
                clone: function() {
                    var d = q.clone.call(this);
                    d._data = this._data.clone();
                    return d
                },
                _minBufferSize: 0
            });
        g.Hasher = t.extend({
            cfg: q.extend(),
            init: function(d) {
                this.cfg = this.cfg.extend(d);
                this.reset()
            },
            reset: function() {
                t.reset.call(this);
                this._doReset()
            },
            update: function(d) {
                this._append(d);
                this._process();
                return this
            },
            finalize: function(d) {
                d && this._append(d);
                return this._doFinalize()
            },
            blockSize: 16,
            _createHelper: function(d) {
                return function(h, c) {
                    return (new d.init(c)).finalize(h)
                }
            },
            _createHmacHelper: function(d) {
                return function(h, c) {
                    return (new k.HMAC.init(d, c)).finalize(h)
                }
            }
        });
        var k = p.algo = {};
        return p
    }(Math);
(function(j) {
    function k(z, y, x, w, r, s, t) {
        z = z + (y & x | ~y & w) + r + t;
        return (z << s | z >>> 32 - s) + y
    }

    function o(z, y, x, w, r, s, t) {
        z = z + (y & w | x & ~w) + r + t;
        return (z << s | z >>> 32 - s) + y
    }

    function g(z, y, x, w, r, s, t) {
        z = z + (y ^ x ^ w) + r + t;
        return (z << s | z >>> 32 - s) + y
    }

    function b(z, y, x, w, s, r, t) {
        z = z + (x ^ (y | ~w)) + s + t;
        return (z << r | z >>> 32 - r) + y
    }
    for (var p = CryptoJS, f = p.lib, l = f.WordArray, q = f.Hasher, f = p.algo, i = [], n = 0; 64 > n; n++) {
        i[n] = 4294967296 * j.abs(j.sin(n + 1)) | 0
    }
    f = f.MD5 = q.extend({
        _doReset: function() {
            this._hash = new l.init([1732584193, 4023233417, 2562383102, 271733878])
        },
        _doProcessBlock: function(W, U) {
            for (var M = 0; 16 > M; M++) {
                var D = U + M,
                    t = W[D];
                W[D] = (t << 8 | t >>> 24) & 16711935 | (t << 24 | t >>> 8) & 4278255360
            }
            var M = this._hash.words,
                D = W[U + 0],
                t = W[U + 1],
                L = W[U + 2],
                v = W[U + 3],
                V = W[U + 4],
                e = W[U + 5],
                X = W[U + 6],
                R = W[U + 7],
                B = W[U + 8],
                E = W[U + 9],
                K = W[U + 10],
                O = W[U + 11],
                h = W[U + 12],
                s = W[U + 13],
                H = W[U + 14],
                c = W[U + 15],
                N = M[0],
                S = M[1],
                Q = M[2],
                P = M[3],
                N = k(N, S, Q, P, D, 7, i[0]),
                P = k(P, N, S, Q, t, 12, i[1]),
                Q = k(Q, P, N, S, L, 17, i[2]),
                S = k(S, Q, P, N, v, 22, i[3]),
                N = k(N, S, Q, P, V, 7, i[4]),
                P = k(P, N, S, Q, e, 12, i[5]),
                Q = k(Q, P, N, S, X, 17, i[6]),
                S = k(S, Q, P, N, R, 22, i[7]),
                N = k(N, S, Q, P, B, 7, i[8]),
                P = k(P, N, S, Q, E, 12, i[9]),
                Q = k(Q, P, N, S, K, 17, i[10]),
                S = k(S, Q, P, N, O, 22, i[11]),
                N = k(N, S, Q, P, h, 7, i[12]),
                P = k(P, N, S, Q, s, 12, i[13]),
                Q = k(Q, P, N, S, H, 17, i[14]),
                S = k(S, Q, P, N, c, 22, i[15]),
                N = o(N, S, Q, P, t, 5, i[16]),
                P = o(P, N, S, Q, X, 9, i[17]),
                Q = o(Q, P, N, S, O, 14, i[18]),
                S = o(S, Q, P, N, D, 20, i[19]),
                N = o(N, S, Q, P, e, 5, i[20]),
                P = o(P, N, S, Q, K, 9, i[21]),
                Q = o(Q, P, N, S, c, 14, i[22]),
                S = o(S, Q, P, N, V, 20, i[23]),
                N = o(N, S, Q, P, E, 5, i[24]),
                P = o(P, N, S, Q, H, 9, i[25]),
                Q = o(Q, P, N, S, v, 14, i[26]),
                S = o(S, Q, P, N, B, 20, i[27]),
                N = o(N, S, Q, P, s, 5, i[28]),
                P = o(P, N, S, Q, L, 9, i[29]),
                Q = o(Q, P, N, S, R, 14, i[30]),
                S = o(S, Q, P, N, h, 20, i[31]),
                N = g(N, S, Q, P, e, 4, i[32]),
                P = g(P, N, S, Q, B, 11, i[33]),
                Q = g(Q, P, N, S, O, 16, i[34]),
                S = g(S, Q, P, N, H, 23, i[35]),
                N = g(N, S, Q, P, t, 4, i[36]),
                P = g(P, N, S, Q, V, 11, i[37]),
                Q = g(Q, P, N, S, R, 16, i[38]),
                S = g(S, Q, P, N, K, 23, i[39]),
                N = g(N, S, Q, P, s, 4, i[40]),
                P = g(P, N, S, Q, D, 11, i[41]),
                Q = g(Q, P, N, S, v, 16, i[42]),
                S = g(S, Q, P, N, X, 23, i[43]),
                N = g(N, S, Q, P, E, 4, i[44]),
                P = g(P, N, S, Q, h, 11, i[45]),
                Q = g(Q, P, N, S, c, 16, i[46]),
                S = g(S, Q, P, N, L, 23, i[47]),
                N = b(N, S, Q, P, D, 6, i[48]),
                P = b(P, N, S, Q, R, 10, i[49]),
                Q = b(Q, P, N, S, H, 15, i[50]),
                S = b(S, Q, P, N, e, 21, i[51]),
                N = b(N, S, Q, P, h, 6, i[52]),
                P = b(P, N, S, Q, v, 10, i[53]),
                Q = b(Q, P, N, S, K, 15, i[54]),
                S = b(S, Q, P, N, t, 21, i[55]),
                N = b(N, S, Q, P, B, 6, i[56]),
                P = b(P, N, S, Q, c, 10, i[57]),
                Q = b(Q, P, N, S, X, 15, i[58]),
                S = b(S, Q, P, N, s, 21, i[59]),
                N = b(N, S, Q, P, V, 6, i[60]),
                P = b(P, N, S, Q, O, 10, i[61]),
                Q = b(Q, P, N, S, L, 15, i[62]),
                S = b(S, Q, P, N, E, 21, i[63]);
            M[0] = M[0] + N | 0;
            M[1] = M[1] + S | 0;
            M[2] = M[2] + Q | 0;
            M[3] = M[3] + P | 0
        },
        _doFinalize: function() {
            var v = this._data,
                t = v.words,
                s = 8 * this._nDataBytes,
                d = 8 * v.sigBytes;
            t[d >>> 5] |= 128 << 24 - d % 32;
            var r = j.floor(s / 4294967296);
            t[(d + 64 >>> 9 << 4) + 15] = (r << 8 | r >>> 24) & 16711935 | (r << 24 | r >>> 8) & 4278255360;
            t[(d + 64 >>> 9 << 4) + 14] = (s << 8 | s >>> 24) & 16711935 | (s << 24 | s >>> 8) & 4278255360;
            v.sigBytes = 4 * (t.length + 1);
            this._process();
            v = this._hash;
            t = v.words;
            for (s = 0; 4 > s; s++) {
                d = t[s], t[s] = (d << 8 | d >>> 24) & 16711935 | (d << 24 | d >>> 8) & 4278255360
            }
            return v
        },
        clone: function() {
            var d = q.clone.call(this);
            d._hash = this._hash.clone();
            return d
        }
    });
    p.MD5 = q._createHelper(f);
    p.HmacMD5 = q._createHmacHelper(f)
})(Math);
(function(d, c, v) {
    function h(a) {
        return a.getFullYear() + "-" + (a.getMonth() + 1) + "-" + a.getDate() + " " + a.getHours() + ":" + a.getMinutes() + ":" + a.getSeconds() + ":" + a.getMilliseconds()
    }

    function B(a, f) {
        var O = f.parentNode;
        O.lastChild == f ? O.appendChild(a) : O.insertBefore(a, f.nextSibling)
    }

    function u(a, f) {
        if (Array.prototype.forEach) {
            Array.prototype.forEach.call(a, f)
        } else {
            for (var O = 0, b = a.length; O < b; O++) {
                f.call(a, a[O], O)
            }
        }
    }

    function m(a) {
        return (a + "").replace(/^\s+/, "").replace(/\s+$/, "")
    }

    function z(a) {
        return (a + "").replace(/\</g, "&lt").replace(/\>/g, "&gt")
    }

    function F(a, f, O, b, d, e) {
        var g = new Date;
        g.setDate(g.getDate() + O);
        c.cookie = a + "=" + encodeURIComponent(f) + ";expires=" + g.toGMTString() + ";path=" + b + ";domain=" + d + (null == e ? "" : ";max-age=" + e)
    }

    function e(a, f, b) {
        F(a, "", new Date(0), f, b)
    }

    function J(a) {
        for (var f = c.cookie.split(";"), b = "", U = 0; U < f.length; U++) {
            if (m(f[U]).substr(0, a.length) == a) {
                b = m(f[U]).substr(a.length + 1);
                break
            }
        }
        return decodeURIComponent(b)
    }

    function s(a) {
        var f = "",
            b = !1;
        if (0 === location.search.length) {
            return f
        }
        if (0 == location.search.indexOf("?") && 1 < location.search.indexOf("=")) {
            for (arrSource = location.search.substring(1, location.search.length).split("&"), P = 0; P < arrSource.length && !b;) {
                0 < arrSource[P].indexOf("=") && arrSource[P].split("=")[0].toLowerCase() == a.toLowerCase() && (f = arrSource[P].split("=")[1], b = !0), P++
            }
        }
        return f
    }

    function L(a, f) {
        if (a === f) {
            return !0
        }
        if (a.constructor !== f.constructor || !(a instanceof Object && f instanceof Object)) {
            return !1
        }
        for (var b in a) {
            if (a.hasOwnProperty(b) && (!f.hasOwnProperty(b) || a[b] !== f[b])) {
                return !1
            }
        }
        for (b in f) {
            if (f.hasOwnProperty(b) && !a.hasOwnProperty(b)) {
                return !1
            }
        }
        return !0
    }

    function M(a, f, b) {
        if (!f) {
            return a
        }
        b = b || /\{([\w-]+)\}/g;
        a = I(a);
        return a.replace(b, function(a, c) {
            if (f[c] !== v) {
                var e;
                e = f[c] instanceof Function ? f[c].call(f) : I(f[c]);
                return b.test(e) ? M(e, f, b) : e
            }
            return d.__debug__ ? c : ""
        })
    }

    function I(a) {
        var f = {
                "&quot;": '"',
                "&#39;": "'"
            },
            b;
        for (b in f) {
            f.hasOwnProperty(b) && (a = (a + "").replace(RegExp(b, "g"), f[b]))
        }
        return a
    }

    function Z(a, f) {
        t.add("objectExtend", f);
        for (var b in f) {
            a[b] = f[b]
        }
        return a
    }

    function Aa(a) {
        for (var f in a) {
            return !1
        }
        return !0
    }

    function ab(a) {
        try {
            return Array.prototype.slice.call(a, 0)
        } catch (f) {
            for (var b = [], c = 0, d = a.length; c < d; c++) {
                b.push(a[c])
            }
            return b
        }
    }

    function g(a, f) {
        a = a || "";
        f = f || c;
        if (0 === a.indexOf("#")) {
            return f.getElementById(a.substring(1))
        }
        var b = [];
        if (/^[a-zA-Z]{1,}$/.test(a)) {
            b = ab(f.getElementsByTagName(a))
        } else {
            if (0 === a.indexOf(".")) {
                if (f.querySelectorAll) {
                    b = ab(f.querySelectorAll(a))
                } else {
                    for (var U = f.getElementsByTagName("*"), d = a.substring(1), e = 0, g = U.length; e < g; e++) {
                        G(U[e], d) && b.push(U[e])
                    }
                }
            }
        }
        return b
    }

    function $(a) {
        return "[object Array]" === Object.prototype.toString.call(a)
    }

    function aa(a, f) {
        for (var b = 0, c = a.length; b < c; b++) {
            if (a[b] === f) {
                return !0
            }
        }
        return !1
    }

    function A(a, f) {
        a && 1 === a.nodeType && ("none" === a.style.display ? a.style.display = f ? "block" : a._oldDisplay || "" : f && (a.style.display = "block"))
    }

    function y(a) {
        a && 1 === a.nodeType && "none" !== a.style.display && (a._oldDisplay = a.style.display || "", a.style.display = "none")
    }

    function x(a, f) {
        if ($(a)) {
            for (var b = 0, c = a.length; b < c; b++) {
                x(a[b], f)
            }
        } else {
            G(a, f) || (a.className = "" === a.className ? f : a.className + (" " + f))
        }
    }

    function G(a, f) {
        if (a.className) {
            var b = a.className.split(/\s+/);
            b.unshift("000");
            b.push("000");
            return 2 < b.length && -1 < b.join(",").indexOf("," + f + ",")
        }
        return !1
    }

    function C(a, f) {
        if ($(a)) {
            for (var b = 0, c = a.length; b < c; b++) {
                C(a[b], f)
            }
        } else {
            if (G(a, f)) {
                for (var b = a.className.split(/\s+/), c = 0, d = b.length; c < d; c++) {
                    if (f === b[c]) {
                        b.splice(c, 1);
                        break
                    }
                }
                a.className = b.join(" ")
            }
        }
    }

    function ba(a, f) {
        var b = ("getComputedStyle" in d ? d.getComputedStyle(a) : a.currentStyle)[f];
        if ("width" === f || "height" === f) {
            b = Math.max(parseInt(b) || 0, a["client" + ea(f)], a["offset" + ea(f)])
        }
        return b
    }

    function ea(a) {
        return (a + "").replace(/^[a-z]/, function(a) {
            return a.toUpperCase()
        })
    }

    function w(a, f, b) {
        a.addEventListener ? a.addEventListener(f, b, !1) : a.attachEvent ? a.attachEvent("on" + f, b) : a["on" + f] = b
    }

    function T(a, f) {
        try {
            a[f]()
        } catch (b) {}
    }

    function r(a) {
        return "string" === typeof a ? d.JSON && d.JSON.parse ? d.JSON.parse(a) : eval("(" + a + ")") : a
    }

    function n(a) {
        var f = {};
        a = (a + "").replace("&&&START&&&", "");
        try {
            f = r(a)
        } catch (b) {}
        return f
    }

    function p(a) {
        if (d.JSON && d.JSON.stringify) {
            return d.JSON.stringify(a)
        }
        var f = [];
        if ("object" == typeof a) {
            if (a instanceof Array) {
                var b = [];
                f.push("[");
                for (var c = 0; c < a.length; c++) {
                    b.push(p(a[c]))
                }
                f.push(b.join());
                f.push("]")
            } else {
                if (null != a) {
                    f.push("{");
                    b = [];
                    for (c in a) {
                        b.push('"' + c + '":' + p(a[c]))
                    }
                    f.push(b.join());
                    f.push("}")
                }
            }
            return f.join("")
        }
        return "number" !== typeof a ? '"' + (a || "") + '"' : a
    }

    function q(a) {
        var f = [],
            b = "",
            c;
        for (c in a) {
            b = typeof a[c], "object" !== b || "number" == b ? f.push(c + "=" + a[c]) : f.push(c + "=" + encodeURIComponent(q(a[c])))
        }
        return f.join("&")
    }

    function fa(a, f) {
        var b = c.createElement("input");
        if (!("placeholder" in b || b._initedplace)) {
            b._initedplace = !0;
            var U = a.getAttribute("placeholder"),
                d = a.id || a.name,
                e = a.className;
            b.value = U;
            b.id = d + "_pla";
            b.className = e;
            x(a, "hideimportant");
            a.setAttribute("pla_id", d + "_pla");
            b.setAttribute("for_id", d);
            b.style.color = "#999";
            a.parentNode.insertBefore(b, a);
            w(b, "focus", function() {
                x(b, "hideimportant");
                C(a, "hideimportant");
                a.focus()
            });
            w(a, "blur", function() {
                "" == m(a.value) && (x(a, "hideimportant"), C(b, "hideimportant"))
            });
            f && (a.value = "", x(a, "hideimportant"), C(b, "hideimportant"));
            try {
                a.focus(), a.blur()
            } catch (g) {}
        }
    }

    function Lb(a, f, b) {
        var d = c.createElement(a);
        "script" === a ? (d.type = "text/script", d.src = f, c.body.appendChild(d)) : (d.rel = "stylesheet", d.type = "text/css", d.href = f, "v3" === b ? c.getElementsByTagName("head")[0].appendChild(d) : (a = c.getElementsByTagName("script").length, a = c.getElementsByTagName("script")[a - 1], a.parentNode.insertBefore(d, a)))
    }

    function bb(a) {
        this.key = a || "account.xiaomi.com"
    }

    function Mb(a) {
        if ("object" !== typeof a) {
            return a
        }
        var f = [],
            b;
        for (b in a) {
            f.push(b + "=" + encodeURIComponent(a[b]))
        }
        return f.join("&")
    }

    function cb(a) {
        this.id = Nb++;
        for (var f in a) {
            a.hasOwnProperty(f) && (this[f] = a[f])
        }
        this.xhr = new(d.XMLHttpRequest || d.ActiveXObject)("Microsoft.XMLHTTP");
        this.request()
    }

    function Ba(a) {
        a = a || {};
        var f = Ob,
            b = {},
            c;
        for (c in f) {
            c in b || c in a || (a[c] = f[c])
        }
        this.opt = a;
        this.init()
    }

    function Pb(a) {
        ra.on(function(f, b) {
            a.style.height = Math.max(f.height, b.height) + "px";
            a.style.width = b.width + "px"
        });
        ra.onbeforeResize(function() {
            a.style.height = "auto";
            a.style.width = "100%"
        })
    }

    function db(a) {
        a = a || [];
        for (var f = "", b = 0; b < a.length; b++) {
            f = "function" === typeof a[b] ? f + a[b]() : f + eb.get(a[b])
        }
        return f
    }

    function fb() {
        var a = "",
            f = "dataCenterZone locale env browser search DefaultRegion outerlinkDone captchaNeed loginType addInputChange manualCode getSmsCode sendServiceLoginTicketLog selectCode resisterResult registerError registerTimeout loginCode recyclePhoneInit loginOrigin resisterOrigin".split(" ");
        u(t.get(), function(b) {
            try {
                var c = {
                    title: b.title,
                    message: b.message
                };
                aa(f, b.title) && (a += z(p(c)))
            } catch (d) {
                a += "stringfy \u51fa\u9519<br>"
            }
        });
        return a
    }

    function sa(a, f) {
        K({
            biz: "loginQr",
            type: k.tickType,
            step: 0
        });
        var c = ba(b.layout, "height"),
            d = ba(b.layout, "width");
        b.qrIframe.height = k.qrsize;
        b.qrIframe.width = k.qrsize;
        b.loginQr.style.height = c + "px";
        b.loginQr.style.width = d + "px";
        var d = b.qrIframe,
            e = k.qrsize,
            g = "",
            h = JSP_VAR;
        s("callback") && s("sid") && (h = location.search);
        if ("object" === typeof h) {
            for (var l in h) {
                h.hasOwnProperty(l) && h[l] && (g += "&" + l + "=" + encodeURIComponent(h[l]))
            }
            g = "?" + g.substring(1)
        } else {
            g = h
        }
        d.src = "/pass/lp" + g + "&_qrsize=" + e;
        "tab" === f ? b.loginQr.style.height = c - 82 + "px" : y(b.loginMain);
        A(b.loginQr, !0);
        !0 === a && x(b.body, "only_qrlogin");
        return !1
    }

    function Ca(a) {
        b.qrIframe.src = "about:blank";
        y(b.loginQr);
        A(b.loginMain, !0);
        !0 === a && x(b.body, "only_pwdlogin");
        return !1
    }

    function Qb(a) {
        var f = gb(a),
            b = hb[a],
            c = "";
        f && b && (c = M('<a href="{url}" class="btnadpt btn_{type} sns-login-link" title="{text}" data-type="{type}">                       <i class="btn_sns_icontype icon_default_{type}"></i><span>{text}</span>                     </a>', {
            url: f,
            type: a,
            text: b
        }));
        return c
    }

    function ma(a, f, b) {
        a = g("input", a);
        for (var c = 0; c < a.length; c++) {
            var d = a[c],
                e = d.name;
            if ("" === e || "hidden" === d.type || "none" === d.style.display && e !== b || e === f) {
                a.splice(c, 1), c--
            }
        }
        return a
    }

    function Rb(a, f, c, d) {
        f = m(f);
        if ("user" === a) {
            if (f !== l.maskedPhone) {
                return "tel" === c ? /^\d{6,}$/.test(f) : !1 === Ia(f) ? !1 : !0
            }
        } else {
            if ("password" === a) {
                if ("number" === c || "tel" === c) {
                    return /^\d{4,6}$/.test(f)
                }
                if (G(d, "set-password")) {
                    return !(8 > f.length || 16 < f.length || /^\d+$/.test(f) || /^[A-Za-z]+$/.test(f) || /^[^A-Za-z0-9]+$/.test(f))
                }
            } else {
                if ("captCode" === a) {
                    return /^\w{4,8}$/.test(f)
                }
                if ("repassword" === a) {
                    return f === b.rePwd.value
                }
            }
        }
        return !0
    }

    function Ja(a, f, c) {
        a = ma(a, f);
        f = 0;
        for (var d = {}, e = 0; e < a.length; e++) {
            var g = a[e],
                h = g.name,
                k = g.value,
                l = g._type || g.type;
            "password" !== h && "repassword" !== h && "visiablepwd" !== h && (k = m(k));
            "" === k ? (H.show(h + "_" + l + "_empty", g), f++) : Rb(h, k, l, g) ? d[h] = "user" === h && "+86" !== m(b.codeValue.innerHTML) ? m(b.codeValue.innerHTML) + k : k : (H.show(h + "_" + l + "_rule", g), f++);
            if (f) {
                break
            }
        }
        return c ? c(f ? !1 : d) : !f
    }

    function ga(a) {
        a = ma(a);
        for (var f = 0; f < a.length; f++) {
            H.clean(a[f])
        }
    }

    function ib() {
        var a = g(".form-panel", b.layout);
        u(a, function(a, b) {
            y(a)
        })
    }

    function fa(a, f) {
        if (!k.supportPlaceholder) {
            var b = c.createElement("span"),
                d = a.parentNode,
                e = a.getAttribute("placeholder");
            b.className = "placehld";
            b.id = a.id + "_pla";
            b.innerHTML = e;
            d.insertBefore(b, a);
            d.style.position = "relative";
            b.style.position = "absolute";
            b.style.cursor = "text";
            b.style.lineHeight = ba(a, "lineHeight") || 1.2;
            b.style.left = (a.offsetLeft || 0) + "px";
            b.style.top = (a.offsetTop || 0) + "px";
            f && (b.style.color = f);
            ha.on(a, function(a, f) {
                "" === a ? A(b) : y(b)
            });
            w(b, D.click, function() {
                try {
                    a.focus(), y(b)
                } catch (f) {}
            })
        }
    }

    function jb(a) {
        if (!k.supportPlaceholder) {
            var f = a.parentNode;
            a = c.getElementById(a.id + "_pla");
            try {
                f.removeChild(a)
            } catch (b) {}
        }
    }

    function Ka(a) {
        t.add("objectCopy", a);
        var f = {},
            b, c = {};
        for (b in a) {
            b in a && !(b in c) && (f[b] = a[b])
        }
        return f
    }

    function Sb(a) {
        w(a, D.focus, function() {
            kb(a)
        });
        w(a, D.blur, function() {
            clearTimeout(a.__checkInputTC)
        })
    }

    function kb(a) {
        var b = a.value,
            c = "__oldVal" in a ? a.__oldVal : a.__oldVal = b,
            d = a._inputChangeFns,
            e;
        if (b !== c) {
            for (var g = 0; g < d.length; g++) {
                "function" === typeof d[g] && !1 === d[g].call(a, b, c, a.__reset) && (e = !1)
            }
        }!1 !== e && (a.__oldVal = b);
        a.__reset && (a.__reset = !1);
        a.__checkInputTC = setTimeout(function() {
            kb(a)
        }, 50)
    }

    function Ia(a) {
        a = {
            miid: /^\d{3,}$/.test(a),
            phoneLike: /^\d{6,}$/.test(a),
            phone: /^\++\d{6,}$/.test(a) || /^0{2}\d{6,}/.test(a),
            emailLike: -1 !== (a + "").indexOf("@"),
            email: /^[\w.\-]+@(?:[A-Za-z0-9]+(?:-[A-Za-z0-9]+)*\.)+[A-Za-z]{2,6}$/.test(a),
            nonum: /[^0-9]/.test(a),
            chsChar: /[\u4e00-\u9fa5]/.test(a)
        };
        return a.chsChar ? !1 : a
    }

    function lb(a, b) {
        F("userName", a, -3650, "/", ".xiaomi.com", 315360000);
        var c = parseInt(a, 10) === b ? b : b + "|" + a;
        LStore.set("user", c)
    }

    function ta(a, f) {
        f = f || k.captChaURL;
        a.src = f + "&" + (new Date).getTime();
        b.captchaCode && (b.captchaCode.__reset = !0) && (b.captchaCode.value = "");
        x(b.layout, "captcha_layout")
    }

    function mb(a) {
        k.captchaInit = 1;
        b.captcha.innerHTML = k.captchaTpl;
        b.captchaCode = g("#captcha-code");
        b.captchaImg = g("#captcha-img");
        fa(b.captchaCode);
        w(b.captchaImg, D.click, function() {
            clearTimeout(b.captchaImg.__refreshImg);
            b.captchaImg.__refreshImg = setTimeout(function() {
                ta(b.captchaImg)
            }, 100)
        });
        w(b.captchaCode, D.keyup, function(a) {
            a = a || d.event;
            13 === (a.charCode || a.keyCode) && (La(), a.returnValue = !1, a.preventDefault && a.preventDefault());
            "cancelBubble" in a && (a.cancelBubble = !0);
            "stopPropagation" in a && a.stopPropagation()
        });
        ha.on(b.captchaCode, function(a, c, d) {
            !d && ga(b.mainForm)
        })
    }

    function nb(a) {
        k.captchaInit && ta(b.captchaImg);
        b.captchaCode && H.clean(b.captchaCode);
        H.show(l.verifyPwd ? E.PWD_RES_ERROR : E.LOGIN_RES_ERROR, b.userName)
    }

    function Ma(a) {
        var f = a.tips ? a.tips : E.password_number_rule;
        a.ignore ? H.show(f) : H.show(f, b.pwd)
    }

    function ob(a) {
        H.show(a.tips ? a.tips : E.TOKEN_EXPIRE)
    }

    function pb(a) {
        H.show(E.FORBIDDEN)
    }

    function qb(a) {
        H.show(E.INTERNAL_ERROR)
    }

    function Tb(a) {
        for (var f = "", c = 0; 10 > c;) {
            f = decodeURIComponent(a);
            if (a === f) {
                break
            }
            a = f;
            c++
        }
        a = z(a);
        a = a.replace(/\$\{(.*)\}\$/g, function(a, b, f) {
            return '<span class="strong-color" style="color:#ff7e00">' + b + "</span>"
        });
        b.header.innerHTML = a
    }

    function Ub() {
        var a;
        a = "<div class='search-code'><i class='icon_search'></i><input type='text' class='search-code-input'></div>" + RegionsCode.getAll({
            usual: E.POPULAR
        }, !0, !0);
        b.codeContainerCon.innerHTML = a;
        b.searchCodeInput = g(".search-code-input", b.codeContainer)[0];
        b.recordCode = g(".record-country", b.codeContainer);
        ha.on(b.searchCodeInput, function(a, c) {
            a = m(a);
            if (0 < a.length) {
                x(b.codeContainer, "search-mode");
                var d = RegionsCode.searchLikeData(a)
            } else {
                return C(b.codeContainer, "search-mode"), !1
            }
            u(b.recordCode, function(a) {
                var b = m(a.getAttribute("data-brief"));
                if (G(a.parentNode.parentNode.parentNode, "countrycode-container-usual")) {
                    return !1
                }
                a: {
                    for (var f = d, f = f || [], c = 0, O; O = f[c++];) {
                        if (b === O.B) {
                            b = !0;
                            break a
                        }
                    }
                    b = !1
                }
                b ? x(a.parentNode, "selected") : C(a.parentNode, "selected")
            })
        });
        w(b.searchCodeInput, D.keydown, function(a) {
            a = a || d.event;
            if (13 == (a.charCode || a.keyCode)) {
                var c = g(".selected", b.codeContainer)[0];
                c && T(c, "click");
                a.returnValue = !1;
                a.preventDefault && a.preventDefault()
            }
            "cancelBubble" in a && (a.cancelBubble = !0);
            "stopPropagation" in a && a.stopPropagation()
        })
    }

    function ia() {
        b.searchCodeInput && (b.searchCodeInput.value = "");
        C(b.codeContainer, "search-mode");
        y(b.codeContainer);
        l.codeShown = !1
    }

    function rb(a) {
        var f = g(".record-country", a)[0];
        a = f.getAttribute("data-code");
        f = f.getAttribute("data-brief");
        b.codeValue.innerHTML = a;
        k.region = f;
        t.add("selectCode", a, f)
    }

    function Vb(a) {
        u(g("a", b.navTabs), function(b, c) {
            b.getAttribute("data-tab") === a ? x(b, "now") : C(b, "now")
        });
        u(b.tabsCon, function(b, c) {
            b.getAttribute("data-con") === a ? A(b, !0) : y(b)
        });
        "qr" === a ? (x(b.loginQr, "tab_qr_area"), sa(!0, "tab")) : Ca(!0)
    }

    function sb(a) {
        C(b.regionCode, "disable");
        m(b.userName.value) || (l.manualControlCode = !1, l.showCodeValue = !1);
        a.phoneLike && !a.phone && (l.manualControlCode ? (C(b.regionCode, "add_regioncode"), l.showCodeValue = !1, ia()) : (x(b.regionCode, "add_regioncode"), l.showCodeValue = !0));
        if (!m(b.userName.value) || a.nonum) {
            C(b.regionCode, "add_regioncode"), ia(), l.manualControlCode || (l.manualControlCode = !1, l.showCodeValue = !1)
        }
        t.add("showCodeValue", l.showCodeValue)
    }

    function tb(a, f, d) {
        var e = Na[a];
        l.currentView = a;
        if (!Na[a]) {
            var e = Na[a] = db([a]),
                h = c.createElement("div");
            h.innerHTML = e;
            h.className = "form-panel";
            h.id = f;
            b.mainContent.appendChild(h);
            b.acRegister = g("#ac-register");
            b.acRegister && (b.acRegisterOkBtn = g(".ok_btn", b.acRegister)[0], b.acRegisterNoBtn = g(".no_btn", b.acRegister)[0], b.agreeCheckBox = g(".icon_select", b.acRegister)[0], b.acqTipsReg = g(".acq_tips", b.acRegister)[0], b.agreeLink = g(".agreement_link", b.acRegister)[0], b.privacyLink = g(".privacy_link", b.acRegister)[0]);
            b.setPwd = g("#set-pwd");
            b.setPwd && (b.setPwdInput = g("input", b.setPwd));
            b.registerButton = g("#register-button");
            b.rePwd = g(".re-password")[0];
            b.acConfirm = g("#ac-confirm");
            b.acConfirm && (b.acConfirmOkBtn = g(".ok_btn", b.acConfirm)[0], b.acConfirmNoBtn = g(".no_btn", b.acConfirm)[0]);
            b.userPhone = g(".user-phone")[0];
            b.registerConfirm = g("#register-confirm");
            b.registerConfirm && (b.registerConfirmOkBtn = g(".ok_btn", b.registerConfirm)[0], b.registerConfirmNoBtn = g(".no_btn", b.registerConfirm)[0]);
            b.agreeLink && b.agreeLink.setAttribute("href", JSP_VAR.agreeLink);
            b.privacyLink && b.privacyLink.setAttribute("href", JSP_VAR.privacyLink);
            d && Wb(a, d)
        }
        "setPwd" === a && u(g("input", b.setPwd), function(a, b) {
            fa(a)
        });
        k.currentBiz && k.currentBiz.bizBg && y(b.bannerIframe);
        ib();
        y(b.footer);
        A(b[a], !0);
        Xb(d, a)
    }

    function Wb(a, f) {
        V = f;
        V.data.nickname ? g(".usernameShow", b[a])[0] && (g(".usernameShow", b[a])[0].innerText = V.data.nickname) : y(g(".us-userName", b[a])[0]);
        g(".us-portraitUrl", b[a])[0] && V.data.portrait && (g(".us-portraitUrl", b[a])[0].innerHTML = '<img src="' + V.data.portrait + '">');
        g(".phoneShow", b[a])[0] && (g(".phoneShow", b[a])[0].innerText = V.data.phone);
        g(".useridShow", b[a])[0] && (g(".useridShow", b[a])[0].innerText = V.data.maskedUserId);
        b.userPhone && (b.userPhone.innerText = Oa.phone || V.data.phone)
    }

    function Xb(a, f) {
        b.registerButton && w(b.registerButton, "click", function(a) {
            a = a || d.event;
            Ja(b.setPwd, !1, function(a) {
                if (a && !Aa(a)) {
                    var b = {
                            noPwd: !1
                        },
                        b = Z(b, a);
                    ub(b, f)
                }
            });
            "cancelBubble" in a && (a.cancelBubble = !0);
            "stopPropagation" in a && a.stopPropagation()
        })
    }

    function vb(a, b) {
        var c = k.recycleUserInfo;
        if (c && c.data && 1 === c.data.registerPwd || 1 === l.registerPwd) {
            return tb("setPwd", "set-pwd"), !1
        }
        ub({
            noPwd: !0
        }, a, b)
    }

    function ub(a, b, c) {
        if (l.lockSubmit) {
            return !1
        }
        var d = Z(na, a);
        l.clientAcq ? d.phoneHash = ca.hash || "" : d.phone = Oa.phone;
        d.region = k.region;
        c && (d = Z(d, c));
        t.add("resisterOrigin", b);
        K({
            biz: "loginRegisterOrigin",
            type: k.tickType,
            step: b
        });
        d.log = fb();
        t.add("resisterLogin", "done");
        Ajax({
            url: "https://account.xiaomi.com/pass/tokenRegister",
            method: "POST",
            data: d,
            success: function(a) {
                l.lockSubmit = 0;
                t.add("resisterResult", a);
                a = n(a.replace("&&&START&&&", ""));
                var b = a.code;
                if (0 === b) {
                    K({
                        biz: "loginRegister",
                        type: k.tickType,
                        step: "end"
                    }), l.clientAcq && (ca.resetCookie(), l.clientAcq = !1), location.href = k.recycleSign ? "/pass/serviceLogin?sid=" + d.sid + "&callback=" + encodeURIComponent(d.callback) : "/pass/serviceLogin" + decodeURIComponent(d.qs)
                } else {
                    if (a.ignore = !0, b in N) {
                        N[b](a)
                    } else {
                        N.regFail(a)
                    }
                }
            },
            error: function(a) {
                t.add("registerError", a.status, a.responseText);
                l.lockSubmit = 0
            },
            timeout: function() {
                t.add("registerTimeout", (new Date).getTime());
                l.lockSubmit = 0
            }
        });
        l.lockSubmit = 1
    }

    function Pa(a, b, c, d) {
        var g = "ticket" !== s("_loginSign") ? "pwd" : "ticket";
        t.add("login", a, b);
        g === l.loginType || k.recycleSign ? wb(a, b, c, d) : (e("userId", "/", "account.xiaomi.com"), e("userId", "/", "xiaomi.com"), e("cUserId", "/", "account.xiaomi.com"), e("cUserId", "/", "xiaomi.com"), g = Ka(na), g._sign = "", g._loginSign = l.loginType, g._json = !0, d && (g = Z(g, d)), Ajax({
            url: "/pass/serviceLogin",
            method: "GET",
            data: g,
            success: function(e) {
                t.add("loginSign", e);
                e = n(e);
                0 !== e.code ? (b._sign = e._sign, b.qs = e.qs, b.callback = e.callback, wb(a, b, c, d)) : (K({
                    biz: "login",
                    type: k.tickType,
                    step: "end"
                }), location.href = e.location)
            }
        }))
    }

    function wb(a, b, c, d) {
        if (l.lockSubmit) {
            return !1
        }
        d && (b = Z(b, d));
        t.add("loginOrigin", c);
        K({
            biz: "loginOrigin",
            type: k.tickType,
            step: c
        });
        b.log = fb();
        Ajax({
            url: a,
            method: "POST",
            data: b,
            success: function(a) {
                l.lockSubmit = 0;
                t.add("loginResult", a);
                a = n(a);
                var c = a.code,
                    d = "";
                if (b.user) {
                    var e = b.user,
                        d = e.replace(e.substring(3, e.length - 3), "***")
                }
                t.add("loginCode", c);
                if (c in N) {
                    N[c](a, e, d)
                } else {
                    N["default"](a, e)
                }
            },
            error: function(a) {
                t.add("loginError", a.status, a.responseText);
                a = a.status;
                var c = b.user;
                a in N ? 0 === a ? (t.add("loginsErrorStatus", "in"), N.network({}, c)) : (t.add("loginsErrorStatus", "out"), N[a]({}, c)) : (t.add("loginsErrorStatus", "fail"), N.fail({}, c));
                l.lockSubmit = 0
            },
            timeout: function() {
                t.add("loginTimeout", (new Date).getTime());
                l.lockSubmit = 0
            }
        });
        l.lockSubmit = 1
    }

    function Yb() {
        Ajax({
            url: "/pass/ip/next",
            method: "GET",
            success: function(a) {
                t.add("ipAddress", a);
                a = n(a);
                if (0 === a.code && !0 === a.data.hasNextUrl) {
                    var b = c.createElement("img");
                    b.src = a.data.url;
                    c.body.appendChild(b);
                    setTimeout(function() {
                        c.body.removeChild(b)
                    }, 5000)
                }
            }
        })
    }

    function xb(a) {
        var b = l.clientAcq ? a.userHash : a.user;
        (oa = Qa[b]) || (oa = Qa[b] = {
            left: 5,
            times: 0
        });
        oa.initQuota ? yb(a) : Zb(b, function(b) {
            oa.left = b;
            oa.initQuota = 1;
            yb(a)
        })
    }

    function yb(a) {
        var b = Qa[l.clientAcq ? a.userHash : a.user];
        0 === b.left ? Ra(b.left) : b.sending ? zb(b, !0) : (b.sending = !0, Ajax({
            url: "/pass/sendServiceLoginTicket",
            method: "post",
            data: a,
            dataType: "text",
            success: function(a) {
                t.add("sendServiceLoginTicket", a);
                t.add("sendServiceLoginTicketLog", "success");
                b.sending = !1;
                var c = {};
                try {
                    c = n(a.replace("&&&START&&&", ""))
                } catch (d) {}
                a = c.code;
                0 === a ? (K({
                    biz: "login",
                    type: k.tickType,
                    step: "sendPhoneTicketSuccess"
                }), b.left = Math.max(b.left - 1, 0), b.hold = (b.times += 1) * $b, zb(b)) : a in N ? (c.send = b, N[a](c)) : N.fail(c)
            },
            error: function() {
                b.sending = !1;
                pa(E.send_again, !1)
            }
        }))
    }

    function zb(a, b) {
        Ra(a.left);
        if (!b) {
            text = E.send_hold;
            var c = function() {
                a.hold--;
                var b = text.replace("{time}", "(" + a.hold + ")");
                1 <= a.hold ? (pa(b, !0), Sa = setTimeout(function() {
                    c()
                }, 980)) : pa(E.send_again, !1)
            };
            clearTimeout(Sa);
            c()
        }
    }

    function pa(a, f) {
        b[ua].innerHTML = a;
        f ? x(b[ua], "disabled") : C(b[ua], "disabled")
    }

    function Zb(a, b) {
        var c = {
            contentType: 160033,
            userId: -1
        };
        l.clientAcq ? c.addressHash = a : c.address = a;
        Ajax({
            url: "/pass/sms/quota",
            method: "POST",
            data: c,
            dataType: "text",
            success: function(a) {
                var c = {};
                try {
                    c = n(a.replace("&&&START&&&", ""))
                } catch (d) {}
                0 === c.result ? b(parseInt(c.info) || 0) : b(0)
            },
            error: function() {
                b(0)
            }
        })
    }

    function Ra(a) {
        var b = E.leftTimesText,
            c = "getSmsCode" === ua ? H : acError;
        2 >= a ? (b = 0 === a ? E.nochance : M(b, {
            left: a
        }), c.show(b)) : c.clean()
    }

    function ac() {
        if (Q.tmpVal) {
            for (var a in Q.data) {
                -1 !== Q.tmpVal.indexOf(a) && (t.add("COMMAND", a), "function" === typeof Q.data[a] && Q.data[a](), Q.tmpVal = "", Q.history.push(a))
            }
        }
    }

    function Ta(a, f) {
        !0 === f && y(b.changeLoginType);
        "block" === g(".err_tip", b[l.currentView])[0].style.display && ga(b.mainForm);
        b.toggleVisiable.__visiable && ("ticket" === a ? (A(b.pwd, !0), y(b.pwdVisiable)) : (y(b.pwd), A(b.pwdVisiable)));
        jb(b.pwd);
        jb(b.userName);
        l.loginType = a;
        l.enableCode = "ticket" === l.loginType ? W ? !0 : !1 : k.enableCode;
        Ab();
        if ("pwd" === a) {
            C(b.regionCode, "add_regioncode");
            C(b.loginPanel, "sms_login");
            C(b.extraLinks, "extra_links");
            y(b.smsCodePanel);
            b.pwd.value = "";
            b.pwdVisiable.value = "";
            b.userName.setAttribute("_type", "text");
            b.pwd.setAttribute("_type", "password");
            try {
                b.userName.type = "text", b.pwd.type = "password"
            } catch (c) {}
            b.userName.setAttribute("placeholder", "Email/Phone/Mi Account");
            b.pwd.setAttribute("placeholder", "Password");
            var d = g(".err_tip", b.loginMain)[0];
            d.parentNode.insertBefore(b.captcha, d);
            d = Ia(b.userName.value, !0);
            l.enableCode && sb(d)
        } else {
            if ("ticket" === a) {
                b.userName.value && !/^\d{6,}$/.test(b.userName.value) && l.maskedPhone !== b.userName.value && (b.userName.value = "", b.clearLink && y(b.clearLink));
                W || (b.codeValue.innerHTML = "+86", x(b.regionCode, "disable"));
                x(b.loginPanel, "sms_login");
                x(b.regionCode, "add_regioncode");
                x(b.extraLinks, "extra_links");
                A(b.smsCodePanel, !0);
                b.pwd.value = "";
                b.userName.setAttribute("_type", "tel");
                if (/FP2801 Build/i.test(navigator.userAgent)) {
                    b.pwd.setAttribute("_type", "tel"), b.userName.type = "tel", b.pwd.type = "tel"
                } else {
                    b.pwd.setAttribute("_type", "number");
                    try {
                        b.userName.type = "tel", b.pwd.type = "number"
                    } catch (e) {}
                }
                b.userName.setAttribute("placeholder", E.PHONE_NUM);
                b.pwd.setAttribute("placeholder", E.SMS_CODE);
                b.pwd.parentNode.parentNode.insertBefore(b.captcha, b.pwd.parentNode)
            }
        }!b.userName.value && fa(b.userName);
        !b.pwd.value && fa(b.pwd)
    }

    function Ab() {
        var a = k.currentBiz && k.currentBiz.pwdText ? k.currentBiz.pwdText : "",
            f = k.currentBiz && k.currentBiz.smsText ? k.currentBiz.smsText : "";
        "ticket" === l.loginType ? (b.loginButton.value = f ? f : "Sign in/Sign up", b.changeLoginType.innerText = a ? a : "Sign in with password") : (b.loginButton.value = a ? a : "Sign in", b.changeLoginType.innerText = f ? f : "Sign in with SMS")
    }

    function La() {
        K({
            biz: "login",
            type: k.tickType,
            subBiz: l.loginType,
            step: "submit"
        });
        if (!Ja(b.mainForm)) {
            return !1
        }
        if ("pwd" === l.loginType && X && !l.useManMachineError) {
            var a = l.showCodeValue ? m(b.codeValue.innerHTML) + m(b.userName.value) : m(b.userName.value);
            X.start({
                uid: a,
                a: (k.zoneDic[JSP_VAR.dataCenterZone] || "en") + "-pwd-login"
            })
        } else {
            Bb()
        }
    }
function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}
    function Bb() {

}
    function Cb() {
        "pwd" === l.loginType ? Bb() : "ticket" === l.loginType && xb(X.sendData)
    }
    var Ua = d.MiLogin || (d.MiLogin = {}),
        bc = function() {
            var a = location.hostname;
            return -1 < a.indexOf("onebox") ? "onebox" : -1 < a.indexOf("preview") ? "preview" : "release"
        }(),
        t = function() {
            var a = [];
            return {
                add: function(b, c, e) {
                    a.push({
                        title: b,
                        message: c,
                        more: e,
                        time: h(new Date)
                    }); - 1 !== (location.search + "").indexOf("debug") && "console" in d && "function" === typeof d.console.log && console.log(arguments)
                },
                get: function() {
                    return a
                }
            }
        }(),
        K = function() {
            var a = {},
                b = [],
                c = "",
                d = null,
                e = 0,
                g = function() {
                    var b = a[c];
                    b && b.callback && b.callback();
                    c = "";
                    clearTimeout(d);
                    d = null;
                    h()
                },
                h = function() {
                    if (!d) {
                        var e = b.shift();
                        if (e) {
                            c = e;
                            var e = q(a[e].data),
                                k = new Image;
                            k.onload = k.oncomplete = k.onerror = g;
                            k.src = "/pass/ajax/tick?" + e;
                            d = setTimeout(function() {
                                d = null;
                                h()
                            }, 1000)
                        }
                    }
                };
            return function(c, d) {
                c._t = (new Date).getTime();
                key = "sendStatus-" + e++;
                c = {
                    key: key,
                    data: c,
                    callback: d
                };
                t.add(key, c);
                a[key] = c;
                b.push(key);
                h()
            }
        }(),
        ja = function() {
            var a = navigator.userAgent,
                b = {};
            /\s+chrome\/([\d\.]*)/i.test(a) ? (b.name = "Chrome", b.version = parseInt(RegExp.$1)) : /msie\s+(\d+\.\d+)/i.test(a) ? (b.name = "IE", b.version = parseFloat(RegExp.$1)) : /\s+firefox\/([\d\.]*)/i.test(a) ? (b.name = "Firefox", b.version = parseInt(RegExp.$1)) : /applewebKit\/([\d\.]*)/i.test(a) ? (b.name = "Webkit", b.version = parseInt(RegExp.$1), /miuibrowser\/([\d\.]*)/i.test(a) && (b.name = "MIUI Browser", b.version = parseInt(RegExp.$1)), /version\/([\d\.]*)\s+Safari/i.test(a) && (b.name = "Safari", b.version = parseInt(RegExp.$1))) : /trident\/([\d\.]*)/i.test(a) ? (a = a.match(/rv:([\d\.]*)/)) && 2 <= a.length ? (b.name = "IE", b.version = parseFloat(a[1])) : (b.name = "Trident", b.version = RegExp.$1) : (b.name = a, b.version = 0);
            return b
        }();
    (function() {
        var a = c.createElement("a");
        a.target = "_blank";
        c.body.appendChild(a);
        var b = 0,
            e = null;
        return function(g, h) {
            if ("_self" === h) {
                location.href = g
            } else {
                a.href = g;
                var k = (new Date).getTime();
                if (!(e === g && 1000 > k - b)) {
                    e = g;
                    b = k;
                    try {
                        var l = c.createEvent("MouseEvents");
                        l.initMouseEvent("click", !0, !0, d);
                        a.dispatchEvent(l)
                    } catch (m) {
                        a.click()
                    }
                }
            }
        }
    })();
    try {
        var Va = !!d.localStorage
    } catch (Gc) {
        Va = !1
    }
    bb.prototype = {
        key: "account.xiaomi.com",
        _read: Va ? function() {
            var a = "";
            try {
                a = d.localStorage.getItem(this.key)
            } catch (b) {}
            a = (new Function("", "return " + a))();
            return "object" == typeof a && a ? a : {}
        } : function() {
            return {}
        },
        _save: Va ? function(a) {
            try {
                d.localStorage.setItem(this.key, p(a))
            } catch (b) {
                t.add("setItem \u629b\u51fa\u5f02\u5e38", ja.name + " " + ja.version)
            }
        } : function() {
            return !1
        },
        _readAndGc: function(a) {
            var b = this._read(),
                c;
            for (c in b) {
                var d = b[c];
                d.expires && (new Date).getTime() - d.time >= d.expires && delete b[c]
            }
            this._save(b);
            return a ? b[a] : b
        },
        remove: function(a) {
            var b = this._readAndGc();
            delete b[a];
            this._save(b)
        },
        get: function(a) {
            a = this._readAndGc(a) || {};
            return a.value ? a.value : null
        },
        set: function(a, b, c) {
            if (!a) {
                return !1
            }
            var d = this._readAndGc(),
                e = (new Date).getTime();
            d[a] = {
                value: b,
                expires: c,
                time: e
            };
            this._save(d)
        }
    };
    d.LStore = new bb("account.xiaomi.com");
    var Nb = 0;
    cb.prototype = {
        request: function() {
            var a = this.url || "?",
                b = this.data || {},
                c = (this.method || "GET").toUpperCase(),
                e = this;
            this.xhr.onreadystatechange = function() {
                e.state = e.xhr.readyState;
                t.add("xhrReadyState", e.xhr.readyState);
                4 == e.xhr.readyState && (d.clearTimeout(e.timeouthandler), e.status = e.xhr.status, t.add("xhrStatus", e.status), 200 == e.xhr.status ? e.success && e.success(e.xhr.responseText, e.xhr) : (t.add("xhrError"), e.error && e.error(e.xhr)))
            };
            b = Mb(b);
            "GET" == c ? (a = -1 === a.indexOf("?") ? a + ("?" + b + "&_dc=" + (new Date).getTime()) : a + ("&" + b + "&_dc=" + (new Date).getTime()), b = null) : a += "?_dc=" + (new Date).getTime();
            t.add("initopen");
            this.xhr.open(c, a, !0);
            this.xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            this.timeouthandler = d.setTimeout(function() {
                t.add("intoTimeout");
                e.timeout()
            }, 5000);
            t.add("initsend");
            this.xhr.send(b)
        },
        timeout: function() {}
    };
    d.Ajax = function(a) {
        return new cb(a)
    };
    var ra = {
            fns: [],
            beforeFns: [],
            inited: !1,
            on: function(a) {
                "function" === typeof a && this.fns.push(a);
                !this.inited && this.init();
                d.onresize && d.onresize()
            },
            off: function(a) {
                if ("function" === typeof a) {
                    for (var b = 0, c = this.fns.length; b < c; b++) {
                        if (a === this.fns[b]) {
                            return this.fns.splice(b, 1), !0
                        }
                    }
                }
                return !1
            },
            onbeforeResize: function(a) {
                "function" === typeof a && this.beforeFns.push(a)
            },
            beforeExec: function() {
                for (var a = 0, b; b = this.beforeFns[a++];) {
                    b && b.call(d)
                }
            },
            exec: function() {
                this.beforeExec();
                var a;
                a = d.innerWidth || 0;
                var b = d.innerHeight || 0;
                a || ("CSS1Compat" == c.compatMode ? (a = c.documentElement.clientWidth, b = c.documentElement.clientHeight) : (a = c.body.clientWidth, b = c.body.clientHeight));
                a = {
                    width: a,
                    height: b
                };
                for (var b = c.documentElement, e = c.body, g = Math.max(b.clientHeight || 0, e.scrollHeight, b.scrollHeight || 0, e.offsetHeight, b.offsetHeight || 0), b = {
                        width: Math.max(b.clientWidth || 0, e.scrollWidth, b.scrollWidth || 0, e.offsetWidth, b.offsetWidth || 0),
                        height: g
                    }, e = c.documentElement, g = c.body, e = {
                        scleft: Math.max(e.scrollLeft || 0, g.scrollLeft),
                        sctop: Math.max(e.scrollTop || 0, g.scrollTop)
                    }, g = 0, h; h = this.fns[g++];) {
                    h && h.call(d, a, b, e)
                }
            },
            init: function() {
                var a = null,
                    b = this;
                d.onresize = function() {
                    d.clearTimeout(a);
                    a = d.setTimeout(function() {
                        b.exec()
                    }, 60)
                }
            },
            triggle: function() {
                this.exec()
            }
        },
        Wa = {},
        R = null,
        Da = c.body,
        Ob = {
            title: "{Modal-DefTitle}",
            cls: "",
            titleCls: "",
            bodyCls: "",
            html: "",
            afterRender: function() {}
        },
        cc = function() {
            var a = 0;
            return function() {
                return "modal-id-" + a++
            }
        }();
    Ba.prototype = {
        init: function() {
            var a = this.opt;
            R || (a.renderTo ? R = a.renderTo : (R = c.createElement("div"), x(R, "modal_container"), R.innerHTML = '<div class="modal_msk"></div>', Da.appendChild(R), !a.modalfixed && Pb(R)));
            this.id = a.id || cc();
            var b = this.modal = Wa[this.id],
                e = this;
            b || (b = this.modal = c.createElement("div"), x(b, "modal_tip"), this.hide(), b.id = this.id, b.innerHTML = '<div class="modal_tip_flex"><div class="modal_tip_hd modal-header"><div class="external_logo_area"><a class="milogo" href="javascript:void(0)"></a></div><div class="modal-header-text modal_tip_title"></div><a href="javascript:void(0)" title="" class="modal-header-close btn_mod_close"><span>Close</span></a></div><div class="modal_tip_bd modal-body"></div></div>', a.renderTo ? a.renderTo.appendChild(b) : R.appendChild(b), this.header = g(".modal-header", b)[0], this.title = g(".modal-header-text", b)[0], this.body = g(".modal-body", b)[0], this.closeBtn = g(".modal-header-close", b)[0], w(this.closeBtn, "click", function() {
                e.close()
            }), this.render(a), Wa[this.id] = b, this.resizeModal = function(c, e, g) {
                e = b;
                var h = "getComputedStyle" in d ? d.getComputedStyle(e) : e.currentStyle;
                e = {
                    width: Math.max(parseInt(h.width) || 0, e.clientWidth, e.offsetWidth),
                    height: Math.max(parseInt(h.height) || 0, e.clientHeight, e.offsetHeight)
                };
                h = c.height;
                c = c.width;
                var O = g.sctop;
                g = g.scleft;
                a.deviceType && "mobile" === a.deviceType || (e && e.height && (b.style.marginTop = e.height < h ? (h - e.height) / 2 + "px" : 0 + O + "px", b.style.top = 0), e && e.width && (b.style.marginLeft = e.width < c ? (c - e.width) / 2 + "px" : 0 + g + "px", b.style.left = 0))
            }, a.modalfixed && (this.resizeModal = function() {}), !a.renderTo && ra.on(this.resizeModal));
            this.show()
        },
        show: function() {
            if (this.modal && (A(R, "hide"), A(this.modal, "hide"), !this.opt.renderTo)) {
                var a = this;
                setTimeout(function() {
                    !a.opt.modalfixed && ra.triggle()
                }, 200)
            }
        },
        beforeClose: function() {
            if (this.opt.beforeClose) {
                return this.opt.beforeClose.call(this)
            }
        },
        close: function(a) {
            if (this.modal) {
                if (!1 === this.beforeClose()) {
                    return 0
                }
                a ? (ra.off(this.resizeModal), R.removeChild(this.modal), this.modal = null, Wa[this.id] = null, y(R, "hide")) : this.hide()
            }
        },
        hide: function() {
            y(R, "hide");
            y(this.modal, "hide")
        },
        render: function(a) {
            this.title.innerHTML = a.title;
            this.body.innerHTML = a.html;
            a.titleCls && x(this.title, a.titleCls);
            a.bodyCls && x(this.body, a.bodyCls);
            a.cls && x(this.modal, a.cls);
            a.afterRender.call(this)
        },
        update: function(a, b) {
            b && (a.titleCls && C(this.title, a.titleCls), a.bodyCls && C(this.body, a.bodyCls), a.cls && C(this.modal, a.cls));
            this.render(a)
        }
    };
    d.Modal = Ba;
    var W = JSP_VAR.dataCenterZone && "China" != JSP_VAR.dataCenterZone,
        ka = JSP_VAR.loginMethods,
        eb = function() {
            var a = {};
            return {
                add: function(b, c) {
                    if (c) {
                        a[b] = c
                    } else {
                        if ("object" === typeof b) {
                            for (var d in b) {
                                b.hasOwnProperty(d) && (a[d] = b[d])
                            }
                        }
                    }
                },
                get: function(b) {
                    return a[b] || ""
                }
            }
        }();
    eb.add({
        wrapper: '<div class="wrapper">              \x3c!-- loading --\x3e              <div class="popup_mask acquirePhoneMask" style="display:none;" id="loadingMask">                <div class="bkc"></div>                <div class="mod_wrap loadingmask">                </div>                <div class="loadingTips">Verifying...</div>              </div>              \x3c!--bg_banner_start--\x3e              <div class="bgiframe">                <iframe name="ifr" style="height:100%" width="100%" height="686" src="about:blank" id="bgiframe" frameborder="0" scrolling="no"></iframe>              </div>              \x3c!--bg_banner_end--\x3e              <div class="wrap">                <div class="layout_panel">                  <div class="layout" id="layout">                    <div id="main-content">                      \x3c!--\u8868\u5355\u8f93\u5165\u767b\u5f55--\x3e                      <div class="mainbox form-panel" id="login-main">                        <div id="custom_display_2"><a class="ercode" id="qrcode-trigger" href="javascript:void(0)"></a></div>                        \x3c!-- header s --\x3e                        <div class="lgnheader">                          <div class="header_tit t_c">                            <em id="custom_display_1" class="milogo">                              <svg width="100%" height="100%" version="1.1" xmlns="http://www.w3.org/2000/svg"><rect width="48" height="48" rx="3" ry="3" style="fill:#ff6700"></rect><rect x="10" y="15" width="4.2" height="18" style="fill:#FFFFFF"></rect><rect x="33.75" y="15" width="4.2" height="18" style="fill:#FFFFFF"></rect><rect x="11.25" y="15" width="15" height="4.1" style="fill:#FFFFFF"></rect><rect x="26.2" y="20.55" width="4.2" height="12.5" style="fill:#FFFFFF"></rect><rect x="20.6" y="15" width="9.8" height="9.8" rx="4.4" ry="4.4" style="fill:#FFFFFF"></rect><rect x="20.2" y="19" width="6" height="6" rx="2" ry="2" style="fill:#ff6700"></rect><rect x="18" y="19.1" width="4" height="2.2" style="fill:#ff6700"></rect><rect x="24.2" y="23" width="1.94" height="10" style="fill:#ff6700"></rect><rect x="18.1" y="22.8" width="4.2" height="10.2" style="fill:#FFFFFF"></rect></svg>                            </em>                            <h4 class="header_tit_txt" id="login-title">Sign in to your Mi Account</h4>                          </div>                        </div>                       \x3c!-- header e --\x3e                        \x3c!-- tab s --\x3e                        <div class="nav_tabs_panel">                          <div id="nav-tabs" class="nav_tabs">                            <a class="navtab-link now" href="javascript:void(0);" data-tab="pwd">Sign in</a><span class="line"></span>                            <a class="navtab-link" href="javascript:void(0);" data-tab="qr">Scan QR code</a>                          </div>                        </div>                        \x3c!-- tab e --\x3e                        \x3c!-- tab con s --\x3e                        <div class="tabs-con tabs_con now" data-con="pwd">                          <div>                            <div class="login_area" id="login-main-form">                                <div class="loginbox c_b">                                  \x3c!-- \u8f93\u5165\u6846 --\x3e                                  <div class="lgn_inputbg c_b login-panel pwdLogin">                                    \x3c!--\u9a8c\u8bc1\u7528\u6237\u540d--\x3e                                    <div class="single_imgarea" id="account-info">                                      <div class="na-img-area" id="account-avator" style="display:none">                                        <div class="na-img-bg-area" id="account-avator-con"></div>                                      </div>                                      <p class="us_name tac" id="account-displayname"></p>                                      <p class="us_id tac"></p>                                    </div>                                    <label id="region-code" class="labelbox login_user c_b" for="">                                      <div class="turn_area"><a class="btn_turn" id="manual_code" href="javascript:void(0);" title="Hide country code"></a></div>                                      <div class="country_list">                                        <div class="animation countrycode_selector" id="countrycode_selector">                                          <span class="country_code"><tt class="countrycode-value" id="countrycode_value"></tt><i class="icon_arrow_down"></i></span>                                        </div>                                      </div>                                      <input class="item_account" autocomplete="off" type="text" name="user" id="username" placeholder="Email/Phone/Mi Account">                                        <input type="hidden" name="log" id="debug_log">                                    </label>                                    <div class="country-container" id="countrycode_container" style="display: none;">                                      <div class="country_container_con" id="countrycode_container_con"></div>                                    </div>                                    <label class="labelbox pwd_panel c_b">                                      <input class="item_account" type="password" placeholder="Password" autocomplete="off" id="pwd" name="password" />                                      <input class="item_account" type="text" placeholder="Password" autocomplete="off" id="visiablePwd" name="visiablepwd" style="display:none" />                                      <div class="eye_panel pwd-visiable">                                        <i class="eye pwd-eye">                                          <svg width="100%" height="100%" version="1.1" xmlns="http://www.w3.org/2000/svg">                                            <path class="eye_outer" d="M0 8 C6 0,14 0,20 8, 14 16,6 16, 0 8 z" />                                            <circle class="eye_inner" cx="10" cy="8" r="3" />                                          </svg>                                          </i>                                      </div>                                      <div id="sms-code-panel" class="code_panel">                                        <a class="send_ticket" href="javascript:;" id="getSMSCode">Get verification code</a>                                      </div>                                    </label>                                  </div>                                  <div class="security_Controller">                                    <label class="checkbox_area">                                      <input type="checkbox" id="trustSecurityController" class="checkbox">Using security control</label>                                  </div>                                  <div id="captcha"></div>                                  \x3c!-- \u9519\u8bef\u4fe1\u606f --\x3e                                  <div id="loadit" style="text-align:center;display:none"><img src="img/load.gif">  </div> <div id="errorid">  </div><div class="err_tip">                                    <div><em class="icon_error"></em><span class="error-con"></span></div>                                  </div>                                  <div class="btns_bg">                                    <input class="btnadpt" id="login-button" type="button" value="Sign in" />                                    <span id="custom_display_8" class="sns-default-container sns_default_container">                                      </span>                                  </div>                                  <div class="other_panel clearfix">                                    <span id="custom_display_256" class="sms_link">                                      <a href="javascript:;" class="btnadpt btn_gray login_type_link" id="ChangeLoginType">Sign in with SMS</a>                                    </span>                                    <div class="reverse" id="extra-links">                                      <div class="n_links_area reg_forget_links reg-forget-links" id="custom_display_64">                                        <a class="outer-link" href="https://account.xiaomi.com/pass/register">Create account</a><span>|</span>                                        <a class="outer-link" href="https://account.xiaomi.com/pass/forgetPassword">Forgot password?</a>                                      </div>                                      <div class="n_links_area sms_unavaliable_links sms-unavaliable-links"><a target="_blank" href="https://static.account.xiaomi.com/html/faq/faqSMSerror.html">Can&#39;t receive verification code?</a></div>                                    </div>                                    \x3c!-- \u5176\u4ed6\u767b\u5f55\u65b9\u5f0f s --\x3e                                    <div style="display:none" class="other_login_type sns-login-container" id="custom_display_16">                                      <fieldset class="oth_type_tit">                                        <legend align="center" class="oth_type_txt">More options</legend>                                      </fieldset>                                      <div id="sns-login-links" class="oth_type_links">                                      </div>                                    </div>                                    \x3c!-- \u5176\u4ed6\u767b\u5f55\u65b9\u5f0f e --\x3e                                    <p class="acq_tips" style="display: none;"></p>                                  </div>                                </div>                            </div>                          </div>                        </div>                        <div class="tabs-con tabs_con" data-con="qr">                        </div>                        \x3c!-- tab con e --\x3e                      </div>                      <div class="ercode_area" id="login-qrcode">                        <div class="ercode_pannel">                          <a class="code_close" href="javascript:void(0)" title="Close" id="qrcode-close"><span class="icon_code_close"></span></a>                          <div class="ercode_box">                            <div class="code_hd">                              <h3 class="code_tit">Scan QR code to sign in</h3>                              <p>Go to Settings > Mi Account on your Mi Phone and tap the Scanner icon to sign in using a QR code.</p>                            </div>                            <div class="code_iframe">                              <iframe style="background:#fff;" src="about:blank" id="qriframe" frameborder="0" scrolling="no" sandbox="allow-scripts allow-same-origin allow-top-navigation allow-modals"></iframe>                            </div>                            <div class="custom_sub_txt">                              <p id="custom-qr-name"></p>                              <p>Go to Settings > Mi Account on your Mi Phone to sign in using a QR code</p>                            </div>                          </div>                        </div>                      </div>                    </div>                  </div>                </div>              </div>            </div>',
        footer: '<div id="custom_display_4" class="n-footer">              <div class="nf-link-area clearfix">                <ul class="lang-select-list">                  <li><a href="javascript:void(0)" data-lang="zh_CN" class="lang-select-li">\u7b80\u4f53</a>|</li>                  <li><a href="javascript:void(0)" data-lang="zh_TW" class="lang-select-li">\u7e41\u4f53</a>|</li>                  <li><a href="javascript:void(0)" data-lang="en" class="lang-select-li">English</a>|</li>                  <li><a href="https://static.account.xiaomi.com/html/faq/faqList.html" target="_blank">FAQ</a>|</li>                  <li><a id="msg-privacy" href="https://account.xiaomi.com/about/protocol/privacy" target="_blank">Privacy Policy</a></li>                </ul>              </div>              <p class="nf-intro"></p>            </div>',
        footerSgp: '<div id="custom_display_4" class="n-footer">                <div class="nf-link-area clearfix">                  <ul class="lang-select-list">                    <li><a href="javascript:void(0)" data-lang="en" id="first-lang-select" class="lang-select-li">English</a></li>                    <li class="page-footer-list">                      <button id="show-more-lang" class="show_more_lang show-more-lang">\u2026</button>|</li>                    <li><a href="https://static.account.xiaomi.com/html/faq/faqList.html" target="_blank">FAQ</a>|</li>                    <li><a id="msg-privacy" href="https://account.xiaomi.com/about/protocol/privacy" target="_blank">Privacy Policy</a></li>                  </ul>                </div>                <p class="nf-intro"></p>              </div>',
        acRegister: '\x3c!-- \u53d6\u53f7\u6ce8\u518c --\x3e      <div class="tac mode_panel">        <h1>Create Mi Account</h1>        <div class="box">          <img src="https://account.xiaomi.com/static/res/bcc9d9f/account-static/respassport/acc-2014/img/2018/sim.png" alt="sim card" width="70" height="70">          <p>Phone:<span class="maskedPhone"></span></p>        </div>        <div class="err_tip">          <div class="dis_box"><em class="icon_error"></em><span class="error-con"></span></div>        </div>        <div class="fixed_bot dis_box">          <a href="javascript:;" class="btnadpt plain ok_btn">Sign up now</a>          <a href="javascript:;" class="btnadpt plain no_btn btn_gray">Sign in with another account</a>        </div>        <p class="acq_tips" style="display: none">\u53d6\u53f7\u6765\u6e90\u4e8e\u4e2d\u56fd\u79fb\u52a8</p>        <p class="agreeTip"><i class="icon_select icon_true"></i>Agree to our <a href="javascript:void(0)" class="agreement_link">User Agreement</a> and <a href="https://account.xiaomi.com/about/protocol/privacy" class="privacy_link">Privacy Policy</a>.</p>      </div>',
        setPwd: '<div class="mode_panel set_pwd_panel">                    <div class="set_pwd_con">                      <h4>Set your password:</h4>                      <label class="labelbox c_b">                        <input class="item_account set-password re-password" type="password" name="password" placeholder="Enter your password">                      </label>                      <label class="labelbox c_b">                        <input class="item_account set-password" name="repassword" type="password" placeholder="Confirm your password">                      </label>                      <div class="err_tip pwd_tip">                        <div class="dis_box"><em class="icon_error"></em><span class="error-con" data-origin="8-16characters, combining at least 2 of the following: digits, letters, and special symbols.">8-16characters, combining at least 2 of the following: digits, letters, and special symbols.</span></div>                      </div>                    </div>                    <div class="btns_bg">                      <a id="register-button" class="btnadpt">Create account</a>                    </div>                  </div>'
    });
    var dc = db(["wrapper", W ? "footerSgp" : "footer"]);
    c.body.innerHTML = dc;
    (function() {
        var a = [{
                key: "zh_CN",
                value: "\u200e\u4e2d\u6587(\u7b80\u4f53)\u200e",
                title: "\u9009\u62e9\u8bed\u8a00",
                data: "cn"
            }, {
                key: "zh_TW",
                value: "\u200e\u200e\u4e2d\u6587(\u7e41\u9ad4)\u200e",
                title: "\u9078\u64c7\u8a9e\u8a00",
                data: "tw"
            }, {
                key: "en",
                value: "\u200eEnglish",
                title: "Select Your Language",
                data: "en"
            }, {
                key: "ko_KR",
                value: "\ud55c\uad6d\uc5b4",
                title: "\uc5b8\uc5b4\ub97c \uc120\ud0dd\ud558\uc138\uc694"
            }, {
                key: "pt_BR",
                value: "Portugu\u00eas (Brasil)\u200e",
                title: "Selecione o seu idioma",
                data: "pt"
            }, {
                key: "in_ID",
                value: "Bahasa Indonesia",
                title: "Pilih Bahasa Anda",
                data: "id"
            }, {
                key: "hi_IN",
                value: "\u0939\u093f\u0928\u094d\u0926\u0940",
                title: "\u0905\u092a\u0928\u0940 \u092d\u093e\u0937\u093e \u091a\u0941\u0928\u0947\u0902",
                data: "hi_IN"
            }, {
                key: "ta_IN",
                value: "\u0ba4\u0bae\u0bbf\u0bb4\u0bcd",
                title: "\u0b89\u0b99\u0bcd\u0b95\u0bb3\u0bcd \u0bae\u0bc6\u0bbe\u0bb4\u0bbf\u0baf\u0bc8 \u0ba4\u0bc7\u0bb0\u0bcd\u0ba8\u0bcd\u0ba4\u0bc6\u0b9f\u0bc1\u0b95\u0bcd\u0b95\u0bb5\u0bc1\u0bae\u0bcd",
                data: "ta_IN"
            }, {
                key: "te_IN",
                value: "\u0c24\u0c46\u0c32\u0c41\u0c17\u0c41",
                title: "\u0c2e\u0c40 \u0c2d\u0c3e\u0c37\u0c28\u0c41 \u0c0e\u0c02\u0c1a\u0c41\u0c15\u0c4b\u0c02\u0c21\u0c3f",
                data: "te_IN"
            }, {
                key: "kn_IN",
                value: "\u0c95\u0ca8\u0ccd\u0ca8\u0ca1",
                title: "\u0ca8\u0cbf\u0cae\u0ccd\u0cae \u0cad\u0cbe\u0cb7\u0cc6\u0caf\u0ca8\u0ccd\u0ca8\u0cc1 \u0c86\u0caf\u0ccd\u0c95\u0cc6 \u0cae\u0cbe\u0ca1\u0cbf",
                data: "kn_IN"
            }, {
                key: "mr_IN",
                value: "\u092e\u0930\u093e\u0920\u0940",
                title: "\u0924\u0941\u092e\u091a\u0940 \u092d\u093e\u0937\u093e \u0928\u093f\u0935\u0921\u093e",
                data: "mr_IN"
            }, {
                key: "ml_IN",
                value: "\u0d2e\u0d32\u0d2f\u0d3e\u0d33\u0d02",
                title: "\u0d24\u0d3e\u0d19\u0d4d\u0d15\u0d33\u0d41\u0d1f\u0d46 \u0d2d\u0d3e\u0d37 \u0d24\u0d3f\u0d30\u0d1e\u0d4d\u0d1e\u0d46\u0d1f\u0d41\u0d15\u0d4d\u0d15\u0d41\u0d15",
                data: "ml_IN"
            }, {
                key: "bn_IN",
                value: "\u09ac\u09be\u0982\u09b2\u09be",
                title: "\u0986\u09aa\u09a8\u09be\u09b0 \u09ad\u09be\u09b7\u09be \u09a8\u09bf\u09b0\u09cd\u09ac\u09be\u099a\u09a8 \u0995\u09b0\u09c1\u09a8",
                data: "bn_IN"
            }, {
                key: "th_TH",
                value: "\u0e20\u0e32\u0e29\u0e32\u0e44\u0e17\u0e22",
                title: "\u0e40\u0e25\u0e37\u0e2d\u0e01\u0e20\u0e32\u0e29\u0e32\u0e02\u0e2d\u0e07\u0e04\u0e38\u0e13",
                data: "th_TH"
            }, {
                key: "vi_VN",
                value: "Ti\u1ebfng Vi\u1ec7t",
                title: "Ch\u1ecdn ng\u00f4n ng\u1eef c\u1ee7a b\u1ea1n",
                data: "vi_VN"
            }, {
                key: "ms_MY",
                value: "Bahasa Melayu",
                title: "Pilih Bahasa Anda",
                data: "ms_MY"
            }, {
                key: "tr_TR",
                value: "T\u00fcrk\u00e7e",
                title: "Dilini Se\u00e7",
                data: "tr_TR"
            }, {
                key: "ar",
                value: "\u0627\u0644\u0639\u0631\u0628\u064a\u0629",
                title: "\u0627\u062e\u062a\u0631 \u0627\u0644\u0644\u063a\u0629",
                data: "ar"
            }, {
                key: "ru_RU",
                value: "\u0420\u0443\u0441\u0441\u043a\u0438\u0439",
                title: "\u0412\u044b\u0431\u0440\u0430\u0442\u044c \u044f\u0437\u044b\u043a",
                data: "ru_RU"
            }, {
                key: "es_US",
                value: "Espa\u00f1ol (Am\u00e9rica)\u200e",
                title: "Seleccionar idioma",
                data: "es_US"
            }, {
                key: "uk_UA",
                value: "\u0423\u043a\u0440\u0430\u0457\u043d\u0441\u044c\u043a\u0430",
                title: "\u0412\u0438\u0431\u0435\u0440\u0456\u0442\u044c \u043c\u043e\u0432\u0443",
                data: "uk_UA"
            }, {
                key: "uz_UZ",
                value: "O'zbekcha",
                title: "Tilni tanlang",
                data: "uz_UZ"
            }, {
                key: "as_IN",
                value: "\u0985\u09b8\u09ae\u09c0\u09af\u09bc\u09be",
                title: "\u09ad\u09be\u09b7\u09be \u099a\u09df\u09a8 \u0995\u09f0\u0995",
                data: "as_IN"
            }, {
                key: "fa_IR",
                value: "\u0641\u0627\u0631\u0633\u06cc",
                title: "\u0627\u0646\u062a\u062e\u0627\u0628 \u0632\u0628\u0627\u0646",
                data: "fa_IR"
            }, {
                key: "fr_FR",
                value: "Fran\u00e7ais",
                title: "S\u00e9lectionnez une langue",
                data: "fr_FR"
            }, {
                key: "it_IT",
                value: "Italiano",
                title: "Scegli la lingua",
                data: "it_IT"
            }, {
                key: "iw_IL",
                value: "\u05e2\u05d1\u05e8\u05d9\u05ea",
                title: "\u05d1\u05d7\u05e8 \u05e9\u05e4\u05d4",
                data: "iw_IL"
            }, {
                key: "my_MM",
                value: "\u1017\u1019\u102c",
                title: "\u1018\u102c\u101e\u102c\u1005\u1000\u102c\u1038\u1000\u102d\u102f\u101b\u103d\u1031\u1038\u1001\u103b\u101a\u103a\u1015\u102b",
                data: "my_MM"
            }, {
                key: "pl_PL",
                value: "Polski",
                title: "Wybierz j\u0119zyk",
                data: "pl_PL"
            }, {
                key: "es_ES",
                value: "Espa\u00f1ol (Espa\u00f1a)\u200e",
                title: "Selecciona idioma"
            }, {
                key: "cs_CZ",
                value: "\u010ce\u0161tina",
                title: "Vyberte jazyk"
            }, {
                key: "el_GR",
                value: "\u0395\u03bb\u03bb\u03b7\u03bd\u03b9\u03ba\u03ac",
                title: "\u0395\u03c0\u03b9\u03bb\u03ad\u03be\u03c4\u03b5 \u03bc\u03b9\u03b1 \u03b3\u03bb\u03ce\u03c3\u03c3\u03b1"
            }, {
                key: "nl_NL",
                value: "Nederlands",
                title: "Selecteer uw taal"
            }, {
                key: "de_DE",
                value: "Deutsch",
                title: "Sprache ausw\u00e4hlen"
            }, {
                key: "ja_JP",
                value: "\u65e5\u672c\u8a9e\u200e",
                title: "\u8a00\u8a9e\u3092\u9078\u629e"
            }, {
                key: "bs_BA",
                value: "Bosanski\u200e",
                title: "Izaberite jezik"
            }, {
                key: "hr_HR",
                value: "Hrvatski",
                title: "Izaberi jezik"
            }, {
                key: "fi_FI",
                value: "Suomi",
                title: "Valitse kieli"
            }, {
                key: "lv_LV",
                value: "Latvie\u0161u",
                title: "Izv\u0113l\u0113ties valodu"
            }, {
                key: "ne_IN",
                value: "\u0928\u0947\u092a\u093e\u0932\u0940",
                title: "\u092d\u093e\u0937\u093e \u091b\u0928\u094c\u091f \u0917\u0930\u094d\u0928\u0941\u0939\u094b\u0938\u094d"
            }, {
                key: "pt_PT",
                value: "Portugu\u00eas (Portugal)",
                title: "Selecionar idioma"
            }, {
                key: "ro_RO",
                value: "Rom\u00e2n\u0103",
                title: "Selecta\u0163i limba"
            }, {
                key: "sr_RS",
                value: "\u0421\u0440\u043f\u0441\u043a\u0438",
                title: "\u0418\u0437\u0430\u0431\u0435\u0440\u0438\u0442\u0435 \u0458\u0435\u0437\u0438\u043a"
            }, {
                key: "sk_SK",
                value: "Sloven\u010dina",
                title: "Vyberte jazyk"
            }, {
                key: "sl_SI",
                value: "Sloven\u0161\u010dina",
                title: "Izberite jezik"
            }],
            b, d = ["<div class='modal-select-list-con'><ul class='lang-select-list lang_items_list c_b'>"],
            e = g("#first-lang-select"),
            h = g("#show-more-lang");
        u(a, function(a, c) {
            var e = "";
            a.key === JSP_VAR.locale && (b = a, e = "current");
            d.push('<li><a href="javascript:void(0)" class="lang-select-li ' + e + '" data-lang="' + a.key + '">' + a.value + "</a></li>")
        });
        d.push("</ul></div>");
        b || (b = -1 !== JSP_VAR.locale.indexOf("zh") ? a[1] : a[2]);
        "en" !== b.key && (a = c.createElement("a"), a.href = "javascript:void(0)", a.className = "current", a.innerHTML = b.value, e.parentNode.insertBefore(a, e));
        var k = new Ba({
            title: b.title,
            cls: "mod_acc_tip more-lang-modal",
            html: d.join(""),
            customDevice640: !0,
            modalfixed: !0,
            afterRender: function() {}
        });
        k.close();
        h.onclick = function() {
            k.show()
        }
    })();
    var Xa;
    (function() {
        Xa = new Ba({
            title: "Tips",
            cls: "mod_acc_tip security-controller-modal",
            html: '<div id="sect-controller-panel" class="security_controller_panel"><h4>You need to install security plug-in to sign in securely.</h4><p>Security controls are used to encrypt your password and enhance the security of the account.</p><p>Click &quot;Install now&quot; button, and follow the steps.</p><div class="tip_msg">After the installation is complete, restart your browser.</div></div><div class="tip_btns"><a title="Install now" href="https://account.xiaomi.com/static/res/0369340/account-static/static/mipay/XiaomiCtrl.exe" class="btn_tip btn_commom btn-action-controller">Install now</a></div>',
            customDevice640: !0,
            modalfixed: !0,
            afterRender: function() {}
        });
        Xa.close()
    })();
    var Ya = [{
            verifyList: {
                name: "mistore",
                deviceType: "PC"
            },
            src: "https://s1.mi.com/loginbanner.html",
            qrName: "Scan using <span>Mi Store</span> app"
        }, {
            verifyList: {
                name: "scfPortal",
                deviceType: "PC"
            },
            src: "https://scf.mi.com/loginbanner.html"
        }, {
            verifyList: {
                name: "mihomeMember",
                deviceType: "weixin"
            },
            src: "https://wx.men.mi.com/member/loginbanner.html",
            smsText: "Sign in with SMS",
            pwdText: "Sign in using password",
            bizBg: !0,
            errorBrdNone: !0,
            snsDefaultHide: !0
        }, {
            verifyList: {
                name: "miotstore",
                deviceType: "mobile"
            },
            title: "Welcome to Youpin"
        }, {
            verifyList: {
                name: "test",
                deviceType: "mobile"
            },
            src: "https://wx.men.mi.com/member/loginbanner.html",
            title: "Customized service title (Not recommended)"
        }, {
            verifyList: {
                name: "test",
                deviceType: "PC"
            },
            src: "https://static.account.xiaomi.com/uiTheme/html/loginbanner.html"
        }],
        Da = c.body,
        D = {
            click: "ontap" in c.body ? "tap" : "click",
            focus: "focus",
            blur: "blur",
            keyup: "keyup",
            keypress: "keypress",
            keydown: "keydown"
        },
        E = {
            SMS_CODE: "Verification code",
            PHONE_NUM: "Phone number",
            VERIFY_PASSWORD: "Enter password",
            VERIFY_PASSWORD_SUBMIT: "OK",
            user_text_empty: "Enter your email address or phone number",
            user_tel_empty: "Enter phone number",
            user_text_rule: "Invalid username format",
            user_tel_rule: "The phone number is invalid",
            password_password_empty: "Enter your password",
            repassword_password_empty: "Confirm your password",
            password_password_rule: "8-16characters, combining at least 2 of the following: digits, letters, and special symbols.",
            repassword_password_rule: "Passwords don&#39;t match",
            PASSWORD_FORMAT: "8-16characters, combining at least 2 of the following: digits, letters, and special symbols.",
            visiablepwd_text_empty: "Enter your password",
            password_number_empty: "Enter code",
            password_number_rule: "The code is invalid",
            password_tel_empty: "Enter code",
            password_tel_rule: "The code is invalid",
            captCode_text_empty: "Enter verification code",
            captCode_text_rule: "The code you entered is incorrect",
            nochance: "You&#39;ve exceeded the number of verification attempts allowed within 24 hours.",
            send_again: "Resend",
            send_hold: "Resend code{time}",
            leftTimesText: "{left} attempt{plural} remaining",
            INIT_CODE_TEXT: "Get verification code",
            Register_Error: "Couldn&#39;t create account",
            TOKEN_EXPIRE: "Your verification info expired, try again.",
            USER_RES_ERROR: "Invalid username format",
            PWD_RES_ERROR: "Invalid password",
            PWD_INPUT_EMPTY: "Enter your password",
            CODE_INPUT_ERROR: "The code you entered is incorrect",
            CODE_RES_ERROR: "The code you entered is incorrect",
            CONFIRM_ACC_TIP: "You won&#39;t be able to sign in to {username} using the phone number {phone} after you create a new account.",
            No_PWD_USER_TIP: "If you don&#39;t have a password, sign in using SMS or select &quot;Forgot password&quot; to restore it.",
            LOGIN_RES_ERROR: "The account ID or password you entered is incorrect.",
            TooMuchRegister: "This phone has been associated with several Mi Accounts in a short period of time. Try using another phone number.",
            REFRESH_IMG_TIP: "Send another verification code",
            LOGIN_FORZEN: "This account has been suspended.",
            POPULAR: "Frequently used",
            INTERNAL_ERROR: "An error occurred",
            NETWORK_ERROR: "Connection timed out. Try again.",
            PHONE_INPUT_ERROR: "The phone number is invalid",
            FORBIDDEN: "Too many sign in attempts. Try again later."
        },
        na = {
            _json: "true",
            callback: JSP_VAR.callback,
            sid: JSP_VAR.sid,
            qs: JSP_VAR.qs,
            _sign: JSP_VAR._sign,
            serviceParam: JSP_VAR.serviceParam
        },
        Oa = {
            phone: ""
        },
        N = {
            0: function(a, b, c) {
                l.clientAcq && (ca.resetCookie(), l.clientAcq = !1);
                t.add("loginPost", "success", a);
                LStore.remove("loginNeedCode");
                t.add("securityStatus", a.securityStatus);
                K({
                    biz: "login",
                    type: k.tickType,
                    step: "success"
                });
                0 === (a.securityStatus || 0) ? (K({
                    biz: "login",
                    type: k.tickType,
                    step: "end"
                }), lb(c, a.userId), href = a.location) : (K({
                    biz: "login",
                    type: k.tickType,
                    step: "endIdentity"
                }), href = a.notificationUrl);
                t.add("href", href);
                location.href = href
            },
            81003: function(a, b, c) {
                t.add("loginPost", "step2", a);
                LStore.remove("loginNeedCode");
                lb(c, a.userId);
                c = Ka(na);
                c.user = encodeURIComponent(b);
                a.qs ? c.qs = encodeURIComponent(a.qs) : delete c.qs;
                a.userId && (c.userId = encodeURIComponent(a.userId));
                a.phone && (c.phoneHint = encodeURIComponent(a.phone));
                a.backupPhone && (c.backupPhone = encodeURIComponent(a.backupPhone));
                c._sign = encodeURIComponent(a._sign);
                c.callback = encodeURIComponent(a.callback);
                c.sid = encodeURIComponent(a.sid);
                c.app = !0;
                a = ["_locale", "_customDisplay", "lsrp_appName", "mini"];
                b = 0;
                for (var d, e; d = a[b++];) {
                    (e = s(d)) && (c[d] = encodeURIComponent(e))
                }
                t.add("twoStepLogin", "queryObj", c);
                c = k.twoStepURL + "?" + q(c);
                location.href = c
            },
            70016: nb,
            20003: function() {
                H.show(E.USER_RES_ERROR, b.userName)
            },
            87001: function(a, c) {
                K({
                    biz: "login",
                    type: k.tickType,
                    step: "captchaError"
                });
                t.add("resNeedCaptcha", "useManMachineError", l.useManMachineError);
                if (X && !l.useManMachineError) {
                    X.start({
                        activeVerify: !0
                    })
                } else {
                    var d = !0;
                    k.captchaNeed || (k.captchaNeed = 1, LStore.set("loginNeedCode", "1", 900000));
                    k.captchaInit || (d = !1, mb(a.captchaUrl));
                    ta(b.captchaImg, a.captchaUrl);
                    d && H.show(E.CODE_RES_ERROR, b.captchaCode);
                    a.send && pa(E.send_again, !1)
                }
            },
            350008: function(a) {
                H.show(E.LOGIN_FORZEN, b.userName)
            },
            403: pb,
            fail: qb,
            10001: qb,
            100001: pb,
            network: function(a) {
                H.show(E.NETWORK_ERROR)
            },
            "default": nb,
            21327: ob,
            21314: ob,
            70002: function() {
                H.show(E.No_PWD_USER_TIP)
            },
            70014: Ma,
            10031: Ma,
            10017: Ma,
            70008: function() {
                H.show(E.user_tel_rule, b.userName)
            },
            70009: function() {
                H.show(E.user_tel_empty, b.userName)
            },
            70022: function(a) {
                a.send && (Ra(oa.left = 0), pa(E.send_again, !1))
            },
            20023: function() {
                var a = g(".btn-box", b[l.currentView])[0];
                H.show(E.TooMuchRegister);
                y(a)
            },
            regFail: function() {
                H.show(E.Register_Error)
            }
        },
        Za = {
            ENTER: 13,
            SHIFT: 16,
            CTRL: 17,
            ALT: 18,
            ESC: 27,
            DEL: 46,
            LEFT: 37,
            UP: 38,
            RIGHT: 39,
            SPACE: 32,
            WIN: 91,
            COMMAND: 91,
            DOWN: 40
        },
        ec = 0 === JSP_VAR.locale.indexOf("zh") ? "zh_CN" === JSP_VAR.locale ? "zh_CN" : "zh_TW" : 0 === JSP_VAR.locale.indexOf("en_") ? "en" : JSP_VAR.locale,
        fc = JSP_VAR.dataCenterZone,
        gc = JSP_VAR.deviceType,
        hc = "mobile" === JSP_VAR.deviceType ? "wap" : "web",
        ic = function() {
            var a = s("_qrsize");
            return parseInt(a) || 270
        }(),
        jc = function() {
            var a = "";
            JSP_VAR.dataCenterZone && "India" === JSP_VAR.dataCenterZone && (a = "ticket");
            var a = s("_loginType") || a,
                b = "all pwd qr ticket pwdonly ticketonly".split(" "),
                c = parseInt(a) || 0;
            return aa(b, a) ? a : b[c] || "all"
        }(),
        kc = JSP_VAR.region,
        lc = W ? "Xiaomi Inc., All rights reserved" : "Xiaomi Inc., All rights reserved - Beijing ICP - 10046444 - <a class='beian-record-link' target='_blank'><span></span>Beijing Public Security ICP-11010802020134</a> - Beijing ICP licence No. - 110507",
        mc = "PC" !== JSP_VAR.deviceType,
        nc = !W,
        oc = JSP_VAR.privacyLink,
        pc = JSP_VAR.isPreview || location.href.indexOf("_debugMode") ? 100 : _t_.samplingRate,
        qc = _t_.samplingBase,
        rc = "placeholder" in c.createElement("input"),
        sc = LStore.get("loginNeedCode"),
        tc = "PC" !== JSP_VAR.deviceType,
        uc = function() {
            var a = !(!W && "zh_CN" === JSP_VAR.locale),
                b = navigator.userAgent;
            u(["Windows CE", "MSIE 7.0; Windows Phone OS 7.0", "MSIE 6.0; Windows NT 5.1"], function(c, d) {
                -1 !== b.indexOf(c) && (a = !1)
            });
            return a
        }(),
        vc = function() {
            var a = W ? ["facebook"] : ["qq", "weibo", "alipay", "weixin"];
            if (W) {
                /(PassportSDK)|(OAuthSDK)|(OAuthMIUI)/ig.test(navigator.userAgent) || a.push("google")
            } else {
                if ("mobile" === JSP_VAR.deviceType && !/MQQBrowser|UCBrowser|[^mobile] safari/gi.test(navigator.userAgent)) {
                    for (var b in a) {
                        "weixin" === a[b] && a.splice(b, 1)
                    }
                }
            }
            return a
        }(),
        wc = function() {
            var a = "qq weibo alipay weixin facebook google".split(" "),
                b = "";
            /micromessenger/i.test(navigator.userAgent) && (b = "weixin");
            s("_snsdefault") && aa(a, s("_snsdefault")) && (b = s("_snsdefault"));
            return b
        }(),
        xc = function() {
            var a = "";
            s("_snsNone") && (a = s("_snsNone"));
            return a
        }();
    /passportsdk\/(notificationwebview|PassportHybridView)/i.test(navigator.userAgent) && x(c.body, "sys_wv");
    var k = {
            locale: ec,
            dataCenterZone: fc,
            deviceType: gc,
            tickType: hc,
            uiThemePath: "https://static.account.xiaomi.com/uiTheme/css/",
            md5pwd: !0,
            infoUrl: "/pass/js/info?type=notice",
            logoWidth: 50,
            qrsize: ic,
            loginType: jc,
            region: kc,
            copyRight: lc,
            copyRightHide: mc,
            getPhoneOn: !1,
            enableSMS: nc,
            privacyLink: oc,
            samplingRate: pc,
            samplingBase: qc,
            supportPlaceholder: rc,
            captchaNeed: sc,
            twoStepURL: "/pass/2StepLogin/login",
            enableVisiablePwd: tc,
            enableCode: uc,
            snsLoginItem: vc,
            snsDefault: wc,
            snsNone: xc,
            ismiui: void 0,
            default1px_gif: "data:image/gif;base64,R0lGODlhAQABAJEAAAAAAP///////wAAACH5BAEAAAIALAAAAAABAAEAAAICVAEAOw==",
            beianRecordLink: "http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=11010802020134",
            beianRecordImg: "https://account.xiaomi.com/static/res/9204d06/account-static/respassport/acc-2014/img/ghs.png",
            captchaTpl: '<div class="lgncode c_b"><label class="labelbox code_label"><input id="captcha-code" class="code" name="captCode" type="text" placeholder="Image verification" autocomplete="off"></label><img class="chkcode_img" id="captcha-img" src="about:blank" alt="Send another verification code"></div>',
            captChaURL: "/pass/getCode?icodeType=login",
            cookieUsageTpl: '<i class="warning_white"></i><div class="text_content"><p class="warning_text">Attention</p><p>This website uses cookies to store info on your device. Cookies help our website work normally and show us how we can improve your user experience. By using this website, you agree to our cookie policy.</p></div><button class="close_cookie_usage close-cookie-usage"><i class="icon_close"></i><span class="btn-text">Agree</span></button>',
            oauthInitNum: 2,
            oauthTpl: '<div class="oauth_box"><p class="title">By signing in you&#39;re granting this app the following permissions</p><div class="scope_list"></div><div class="oauth_wrap clearfix"><a href="javascript:;" class="wrap_more fl">More</a><i class="icon_caret fl"></i></div></div>',
            bizTheme: {
                bizName: JSP_VAR.theme,
                bizDeviceType: JSP_VAR.bizDeviceType
            },
            useManMachine: "true" === JSP_VAR.useManMachine,
            zoneDic: {
                China: "cn",
                Russia: "ru"
            }
        },
        yc = k.enableCode,
        Db;
    Db = ka && ka.length && $(ka) ? ka[0].toLowerCase() : "pwd";
    var l = {
            lockSubmit: 0,
            codeShown: !1,
            codeInit: !1,
            enableCode: yc,
            loginType: Db,
            registerPwd: 0,
            clientAcq: !1,
            maskedPhone: "",
            currentView: "loginMain",
            showCustomPage: function() {
                for (var a = {
                        deviceType: k.bizTheme.bizDeviceType,
                        name: k.bizTheme.bizName
                    }, b = 0; b < Ya.length; b++) {
                    var c = Ya[b];
                    if (L(a, c.verifyList)) {
                        return k.currentBiz = c, !0
                    }
                }
                return !1
            }(),
            useManMachineError: !1
        },
        da = {
            LOGO: 1,
            QRTRIGGER: 2,
            FOOTER: 4,
            SNSDEFAULT: 8,
            SNSLOGIN: 16,
            SMSBTN: 256,
            OUTERLINK: 64
        },
        hb = {
            qq: "Sign in with QQ",
            weibo: "Sign in with Weibo",
            weixin: "Sign in with WeChat",
            alipay: "Sign in with Alipay",
            facebook: "Sign in with Facebook",
            google: "Sign in with Google"
        },
        b = {
            body: c.body,
            layout: g("#layout"),
            footer: g(".n-footer")[0],
            header: g("#login-title"),
            loginMain: g("#login-main"),
            mainContent: g("#main-content"),
            loginQr: g("#login-qrcode"),
            loginButton: g("#login-button"),
            qrIframe: g("#qriframe"),
            qrTrigger: g("#qrcode-trigger"),
            qrClose: g("#qrcode-close"),
            regionCode: g("#region-code"),
            codeSelector: g("#countrycode_selector"),
            codeContainer: g("#countrycode_container"),
            codeContainerCon: g("#countrycode_container_con"),
            codeValue: g("#countrycode_value"),
            manualCode: g("#manual_code"),
            userName: g("#username"),
            snsLogin: g("#sns-login-links"),
            pwd: g("#pwd"),
            outerLink: g(".outer-link"),
            captcha: g("#captcha"),
            langSelect: g(".lang-select-li"),
            mainForm: g("#login-main-form"),
            error: g("#error-outcon"),
            accountInfo: g("#account-info"),
            accountAvator: g("#account-avator"),
            accountAvatorCon: g("#account-avator-con"),
            accountDisplayname: g("#account-displayname"),
            snsDefaultCon: g(".sns-default-container")[0],
            snsLoginCon: g(".sns-login-container")[0],
            recordLink: g(".beian-record-link")[0],
            pwdVisiable: k.enableVisiablePwd && g("#visiablePwd"),
            toggleVisiable: g(".pwd-visiable")[0],
            pwdEye: g(".pwd-eye"),
            msgPrivacy: g("#msg-privacy"),
            securityControllerPanel: g(".security_Controller")[0],
            securityController: g("#trustSecurityController"),
            navTabs: g("#nav-tabs"),
            tabsCon: g(".tabs-con"),
            copyRight: g(".nf-intro")[0],
            bannerIframe: g("#bgiframe"),
            customQrName: g("#custom-qr-name"),
            loginPanel: g(".login-panel")[0],
            smsCodePanel: g("#sms-code-panel"),
            phone: g("#phoneNum"),
            smsCode: g("#ticket"),
            getSmsCode: g("#getSMSCode"),
            changeLoginType: g("#ChangeLoginType"),
            acBox: g(".ac-box")[0],
            loadingMask: g("#loadingMask"),
            extraLinks: g("#extra-links")
        },
        V = {};
    u("ABCDEFGHIGKLMNOPQRSTUVWXYZ".split(""), function(a, b) {
        Za[a] = a.charCodeAt()
    });
    u("abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIGKLMNOPQRSTUVWXYZ".split(""), function(a) {
        a.charCodeAt()
    });
    var Q = {
            data: {
                "*#*#284#*#*": function() {
                    var a = "";
                    u(t.get(), function(b) {
                        try {
                            a += z(p(b)) + "<br/>"
                        } catch (c) {
                            a += "stringfy \u51fa\u9519<br>"
                        }
                    });
                    c.write(a);
                    c.close()
                }
            },
            history: [],
            tmpVal: ""
        },
        Eb = function() {
            var a = {};
            w(Da, D.keydown, function(b) {
                b = b || d.event;
                var c = b.keyCode || b.charCode,
                    e = b.target || b.srcElement,
                    g;
                c in a && u(a[c] || [], function(a, b) {
                    !1 === a.call(e || d) && (g = !1)
                });
                !1 === g && (b.returnValue = !1, b.preventDefault && b.preventDefault())
            });
            return {
                on: function(b, c) {
                    (a[b] || (a[b] = [])).push(c)
                },
                off: function(b, c) {
                    var d = a[b] || (a[b] = []);
                    u(d, function(a, b) {
                        c === a && d.splice(b, 1)
                    })
                }
            }
        }(),
        gb = function() {
            var a = "PC" === k.deviceType,
                b = {
                    qq: "100284651",
                    weibo: "2996826273",
                    weixin: a ? "wxxmzh" : "wxxmh5",
                    alipay: "2088011127562160",
                    facebook: "222161937813280",
                    google: "google"
                },
                a = a ? "snsapi_login" : "snsapi_userinfo",
                c = decodeURIComponent(s("third"));
            c || (c = encodeURIComponent(JSP_VAR.callback) + "&sid=" + JSP_VAR.sid);
            var d = {},
                e;
            for (e in b) {
                d[e] = ""
            }
            return function(a) {
                return a ? d[a] : d
            }
        }(),
        zc = function() {
            for (var a = location.search.substring(1).split("&"), b = 0; b < a.length; b++) {
                0 === a[b].indexOf("_locale=") && (a.splice(b, 1), b--)
            }
            return function(b) {
                return "?" + a.join("&") + "&_locale=" + b
            }
        }(),
        H = function() {
            return {
                show: function(a, c) {
                    var d = E[a] || a,
                        e = g(".err_tip", b[l.currentView])[0],
                        h = g(".error-con", e)[0];
                    c && (k.currentBiz && k.currentBiz.errorBrdNone ? C(c.parentNode, "error_bg") : x(c.parentNode, "error_bg"));
                    c && "captCode" === c.name && (c.value = "");
                    h.innerHTML = d;
                    C(e, "pwd_tip");
                    A(e, !0)
                },
                clean: function(a) {
                    var c = g(".err_tip", b[l.currentView])[0],
                        d = g(".error-con", c)[0];
                    a && C(a.parentNode, "error_bg");
                    a && G(a, "set-password") ? (x(c, "pwd_tip"), d.innerHTML = E.PASSWORD_FORMAT) : (y(c), d.innerHTML = "")
                }
            }
        }(),
        ha = function() {
            return {
                on: function(a, b) {
                    var c = a._inputChangeFns;
                    c || (c = a._inputChangeFns = [], Sb(a));
                    c.push(b)
                },
                off: function(a, b) {
                    for (var c = a._inputChnageFns, d = 0; d < c.length; d++) {
                        b === c[d] && (c.splice(d, 1), d--)
                    }
                }
            }
        }(),
        va = function() {
            return function(a, b) {
                if ("number" === typeof a) {
                    for (var c = 0; 8 >= c; c++) {
                        var d = a & 1 << c,
                            e = b,
                            h = g("#custom_display_" + d);
                        d && (e ? A(h) : y(h))
                    }
                }
            }
        }(),
        Na = {},
        $b = 60,
        Sa = null,
        Qa = {},
        oa = {},
        ua = "getSmsCode";
    w(b.getSmsCode, "click", function() {
        K({
            biz: "login",
            type: k.tickType,
            step: "sendPhoneTicket"
        });
        if (!G(this, "disabled")) {
            ga(b.mainForm);
            ua = "getSmsCode";
            var a = "+86" === m(b.codeValue.innerHTML) ? m(b.userName.value) : m(b.codeValue.innerHTML) + m(b.userName.value),
                c = {
                    sid: "passport"
                };
            Ja(b.mainForm, "password", function(b) {
                t.add("getSmsCode", b);
                b && !Aa(b) && (c = Z(c, b), l.clientAcq && b.user === l.maskedPhone ? (c.userHash = ca.hash, b.user && delete b.user) : l.clientAcq = !1, X ? (X.start({
                    uid: a,
                    a: (k.zoneDic[JSP_VAR.dataCenterZone] || "en") + "-ticket-login"
                }), X.sendData = c) : xb(c))
            })
        }
    });
    var ca = function() {
            var a = function() {
                    w(b.acRegisterOkBtn, D.click, function() {
                        G(this, "disabled") || vb("acRegister")
                    });
                    w(b.acRegisterNoBtn, D.click, function() {
                        d();
                        l.clientAcq = !1;
                        ib();
                        H.clean();
                        clearTimeout(Sa);
                        pa(E.INIT_CODE_TEXT, !1);
                        k.currentBiz && k.currentBiz.bizBg && A(b.bannerIframe, !0);
                        A(b.loginMain);
                        A(b.footer);
                        l.currentView = "loginMain";
                        for (var a = ma(b.mainForm), c = 0; c < a.length; c++) {
                            var e = a[c];
                            e.value = "";
                            k.captchaInit && "captCode" === e.name && ta(b.captchaImg)
                        }
                    });
                    w(b.agreeCheckBox, D.click, function() {
                        G(this, "icon_true") ? C(this, "icon_true") : x(this, "icon_true");
                        G(this, "icon_true") ? C(b.acRegisterOkBtn, "disabled") : x(b.acRegisterOkBtn, "disabled")
                    })
                },
                c = function() {
                    var a = Base64.decode(J("operator")) || "",
                        c = Base64.decode(J("operatorLink")) || "",
                        d = g(".acq_tips", b[l.currentView])[0];
                    d.innerHTML = '<a href="' + c + '">' + a + "</a>";
                    A(d)
                },
                d = function() {
                    F("hash", "", -1, "/", ".account.xiaomi.com", wa);
                    F("activatorToken", "", -1, "/", ".account.xiaomi.com", wa);
                    F("operator", "", -1, "/", ".account.xiaomi.com", wa);
                    F("operatorLink", "", -1, "/", ".account.xiaomi.com", wa)
                };
            return {
                start: function() {
                    var d = J("hash");
                    "" !== d && "" !== J("activatorToken") && Ajax({
                        url: "/pass/phoneInfo",
                        method: "POST",
                        data: {
                            userHash: d,
                            sid: na.sid
                        },
                        success: function(d) {
                            t.add("phoneInfo", d);
                            V = d = n(d);
                            if (0 === d.code) {
                                switch (l.clientAcq = !0, l.registerPwd = d.data.registerPwd, l.maskedPhone = d.data.phone, d.data.status) {
                                    case 2:
                                        c();
                                        b.userName.value = d.data.phone;
                                        break;
                                    case 0:
                                        tb("acRegister", "ac-register", d), g(".maskedPhone", b.acRegister)[0].innerText = l.maskedPhone, c(), a()
                                }
                            }
                        }
                    })
                },
                resetCookie: d,
                hash: J("hash")
            }
        }(),
        Ac = {
            start: function(a) {
                d.miAccGetTokenHandler = function(a) {
                    0 === a.code && ((new Image).src = a.url)
                };
                (function(a) {
                    var b = c.createElement("script");
                    b.src = a;
                    c.body.insertBefore(b, c.body.firstChild)
                })("https://act.account.xiaomi.com/h5/getAccessToken")
            }
        };
    t.add("JSP_VAR", d.JSP_VAR);
    t.add("dataCenterZone", d.JSP_VAR.dataCenterZone);
    t.add("locale", d.JSP_VAR.locale);
    t.add("_d_", d._d_);
    t.add("_t_", d._t_);
    t.add("bizConfig", Ya);
    t.add("CONF", k);
    t.add("STAT", l);
    t.add("MSG", E);
    t.add("env", bc);
    t.add("browser", ja);
    t.add("search", location.search);
    t.add("=====================================\u5206\u5272\u7ebf==========================", "=====================================================================");
    K({
        biz: "login",
        type: k.tickType,
        step: 0
    });
    k.getPhoneOn && Ac.start();
    w(Da, "PC" === k.deviceType ? D.keypress : "input", function(a) {
        a = a || d.event;
        if ("input" === a.type && "user" === a.target.name) {
            if (a = a.target.value) {
                Q.tmpVal = a
            }
        } else {
            if (a = a.charCode || a.keyCode) {
                Q.tmpVal += String.fromCharCode(a)
            }
        }
        clearTimeout(Q.tc);
        Q.tc = setTimeout(ac, 50)
    });
    if (l.showCustomPage) {
        var Ea = k.bizTheme.bizName,
            $a = k.bizTheme.bizDeviceType;
        Ea && $a && Lb("link", k.uiThemePath + Ea + "/login_" + Ea + ("PC" === $a ? ".css" : "weixin" === $a ? "_wx.css" : "_wap.css"), "v3");
        x(b.body, Ea + "_theme");
        k.currentBiz && (k.currentBiz.qrName && (b.customQrName.innerHTML = k.currentBiz.qrName), b.bannerIframe && k.currentBiz.src && (b.bannerIframe.src = k.currentBiz.src), k.currentBiz.title && (b.header.innerHTML = k.currentBiz.title), k.currentBiz.navTitle && (b.navTabs.innerHTML = k.currentBiz.navTitle), k.currentBiz.snsDefaultHide && va(da.SNSDEFAULT));
        Ab()
    }!s("_noAcq") && k.enableSMS && s("lsrp_appName") && ca.start();
    if (l.enableCode) {
        var Fa = RegionsCode.search(k.region || k.locale.split("_")[1] || "cn");
        Fa && (t.add("DefaultRegion", Fa), RegionsCode.addUsual(Fa), b.codeValue.innerHTML = (Fa.N + "").replace(/^00/, "+"))
    }
    fa(b.userName);
    fa(b.pwd);
    ka && ka.length && ("ticket" === l.loginType && Ta(l.loginType), 1 === ka.length && y(b.changeLoginType));
    if ("qr" === k.loginType) {
        sa(!0)
    } else {
        if ("all" !== k.loginType) {
            var Fb = !1;
            0 < k.loginType.indexOf("only") && (Fb = !0, Ca(!0), x(b.navTabs, "only"));
            l.loginType = k.loginType.split("only")[0];
            Ta(l.loginType, Fb)
        }
    }
    s("_showQr") && ("false" === s("_showQr") ? Ca(!0) : "true" === s("_showQr") && A(b.qrTrigger, !0));
    w(b.qrTrigger, D.click, sa);
    w(b.qrClose, D.click, Ca);
    w(b.qrTrigger, D.focus, function() {
        Eb.on(Za.SPACE, sa)
    });
    w(b.qrTrigger, D.blur, function() {
        Eb.off(Za.SPACE, sa)
    });
    var xa = "";
    try {
        xa = d.miui.getDeviceCloudHashId(), t.add("deviceId", xa)
    } catch (Hc) {}
    if (xa && 10 < xa.length) {
        var wa = 1892160000;
        F("deviceId", xa, 21900, "/", ".account.xiaomi.com", wa)
    }
    J("ipAddress") || "China" !== k.dataCenterZone || Yb();
    u(b.outerLink, function(a, b) {
        var c = a.href,
            d = "";
        /\/pass\/(\w+)/.test(c) && (d = RegExp.$1);
        a.href = c + location.search;
        t.add("outerlink" + b, c);
        w(a, "click", function() {
            K({
                biz: "login",
                type: k.tickType,
                step: d
            })
        })
    });
    t.add("outerlinkDone", "done");
    b.msgPrivacy && (b.msgPrivacy.href = k.privacyLink);
    b.copyRight.innerHTML = k.copyRight;
    b.recordLink = g(".beian-record-link")[0];
    k.copyRightHide && y(b.copyRight);
    if (k.snsDefault) {
        var S = Qb(k.snsDefault);
        S && b.snsDefaultCon && (b.snsDefaultCon.innerHTML = S, w(b.snsDefaultCon, "click", function() {
            K({
                biz: "login",
                type: k.tickType,
                step: k.snsDefault
            })
        }))
    } else {
        S = "";
        t.add("snsLoginItem", k.snsLoginItem);
        for (var P in k.snsLoginItem) {
            var Y = k.snsLoginItem[P],
                S = S + ('<a class="icon_type btn_' + Y + ' sns-login-link" data-type="' + Y + '" href="javascript:void(0)" title="' + hb[Y] + '"><i class="btn_sns_icontype icon_default_' + Y + '"></i></a>')
        }
        S && b.snsLogin && (b.snsLogin.innerHTML = S);
        u(g(".sns-login-link", b.snsLogin), function(a, b) {
            var c = a.getAttribute("data-type"),
                d = gb(c);
            t.add("snsloginlink", c, d);
            d && (a.href = d, a.target = "_blank");
            w(a, "click", function() {
                K({
                    biz: "login",
                    type: k.tickType,
                    step: c
                })
            })
        });
        b.snsLoginCon && A(b.snsLoginCon, !0)
    }
    u(b.langSelect, function(a, b) {
        var c = a.getAttribute("data-lang");
        c === k.locale ? x(a, "current") : (a.href = zc(c), t.add("langInit", c))
    });
    t.add("linkInit", "done", "register,forgetPwd,snsLogin,languageSelect,loginBanner");
    k.captchaNeed && k.useManMachine && (t.add("captchaNeed", "pageinitNeed"), mb(), ta(b.captchaImg));
    if ("mobile" === k.deviceType) {
        var Ga = c.createElement("div");
        Ga.id = "btn-clear-link";
        Ga.className = "clear_link_panel";
        Ga.innerHTML = '<span class="clear_link"></span>';
        b.regionCode.appendChild(Ga);
        b.clearLink = g("#btn-clear-link")
    }
    b.inputs = ma(b.layout);
    u(b.inputs, function(a, c) {
        ha.on(a, function(a, c) {
            ga(b[l.currentView])
        })
    });
    ha.on(b.userName, function(a, c) {
        l.clientAcq && (b.userName.value = "", y(b.acqTipsMain), ca.resetCookie(), l.clientAcq = !1);
        var d = Ia(a, !0);
        ga(b.mainForm);
        b.clearLink && (m(b.userName.value) ? A(b.clearLink, !0) : y(b.clearLink));
        l.enableCode && "pwd" === l.loginType && sb(d)
    });
    ha.on(b.pwd, function(a, c) {
        ga(b.mainForm);
        b.pwdVisiable && (b.pwdVisiable.value = a)
    });
    b.pwdVisiable && ha.on(b.pwdVisiable, function(a, c) {
        ga(b.mainForm);
        b.pwd.value = a
    });
    w(b.toggleVisiable, "click", function(a) {
        a = a || d.event;
        b.toggleVisiable.__visiable ? (b.toggleVisiable.__visiable = !1, C(b.pwdEye, "chk"), A(b.pwd), y(b.pwdVisiable), T(b.pwd, "focus")) : (b.toggleVisiable.__visiable = !0, x(b.pwdEye, "chk"), y(b.pwd), A(b.pwdVisiable), T(b.pwdVisiable, "focus"));
        "cancelBubble" in a && (a.cancelBubble = !0);
        "stopPropagation" in a && a.stopPropagation()
    });
    b.clearLink && w(b.clearLink, "click", function() {
        var a = ma(b.loginMain, !1, "visiablepwd");
        u(a, function(a, b) {
            a.value = ""
        });
        "pwd" === l.loginType && C(b.regionCode, "add_regioncode");
        y(b.clearLink);
        T(b.userName, "focus")
    });
    w(b.changeLoginType, "click", function() {
        K({
            biz: "login",
            type: k.tickType,
            subBiz: "ticket" === l.loginType ? "pwd" : "ticket",
            step: "changeLoginType"
        });
        "ticket" !== l.loginType ? l.loginType = "ticket" : l.loginType = "pwd";
        Ta(l.loginType);
        t.add("loginType", l.loginType)
    });
    if (!0 === JSP_VAR.showActiveXControl) {
        if ("IE" === ja.name || "Firefox" === ja.name) {
            A(b.securityControllerPanel, !0), t.add("activeXControl", "true")
        }
    } else {
        y(b.securityControllerPanel)
    }
    var Gb = !1;
    b.securityController && (b.securityController.checked = Gb ? !0 : !1);
    w(b.securityController, D.click, function() {
        var a = !0;
        try {
            new ActiveXObject("XiaomiEdit.XiaomiEditCtrl.1")
        } catch (d) {
            a = !1
        }
        a = "IE" === ja.name && a || navigator.plugins["Xiaomi Safe Control for NP"];
        (Gb = b.securityController.checked) ? a ? (y(b.pwd), a = c.createElement("div"), x(a, "pwd-object"), "IE" === ja.name ? (a.innerHTML = '<object id="XiaomiEdit" name="XiaomiEdit" classid="CLSID:E0A362BA-2608-48EA-9D8F-F45258D3091C" width="358" height="50"></object>', b.pwd.parentNode.appendChild(a), c.getElementById("XiaomiEdit")) : (a.innerHTML = '<object type="application/npXiaomiEditCtl-Plugin" id="npXiaomiEdit" name="XiaomiEdit" width="358" height="48"></object>', b.pwd.parentNode.appendChild(a), c.getElementById("npXiaomiEdit")), C(b.pwd.parentNode, "labelbox")) : Xa.show(): (A(b.pwd), x(b.pwd.parentNode, "labelbox"), g(".pwd-object")[0] && b.pwd.parentNode.removeChild(g(".pwd-object")[0]), a && (b.pwd.value = ""))
    });
    t.add("stoppropagation keyevent", D.keydown + "," + D.keyup + "," + D.keypress);
    w(b.pwd, D.keydown, function(a) {
        a = a || d.event;
        "cancelBubble" in a && (a.cancelBubble = !0);
        "stopPropagation" in a && a.stopPropagation()
    });
    w(b.pwd, D.keyup, function(a) {
        a = a || d.event;
        "cancelBubble" in a && (a.cancelBubble = !0);
        "stopPropagation" in a && a.stopPropagation()
    });
    w(b.pwd, D.keypress, function(a) {
        a = a || d.event;
        "cancelBubble" in a && (a.cancelBubble = !0);
        "stopPropagation" in a && a.stopPropagation()
    });
    b.pwdVisiable && (w(b.pwdVisiable, D.keydown, function(a) {
        a = a || d.event;
        "cancelBubble" in a && (a.cancelBubble = !0);
        "stopPropagation" in a && a.stopPropagation()
    }), w(b.pwdVisiable, D.keyup, function(a) {
        a = a || d.event;
        "cancelBubble" in a && (a.cancelBubble = !0);
        "stopPropagation" in a && a.stopPropagation()
    }), w(b.pwdVisiable, D.keypress, function(a) {
        a = a || d.event;
        "cancelBubble" in a && (a.cancelBubble = !0);
        "stopPropagation" in a && a.stopPropagation()
    }));
    t.add("addInputChange", "userName");
    w(b.loginButton, "click", function(a) {
        La()
    });
    var Bc = ma(b.mainForm);
    u(Bc, function(a, b) {
        w(a, D.keydown, function(a) {
            a = a || d.event;
            13 === (a.charCode || a.keyCode) && (La(), a.returnValue = !1, a.preventDefault && a.preventDefault());
            "cancelBubble" in a && (a.cancelBubble = !0);
            "stopPropagation" in a && a.stopPropagation()
        })
    });
    var Hb = parseInt(s("_customDisplay")) || 0;
    va(Hb);
    "true" === k.snsNone ? va(da.SNSLOGIN + da.SNSDEFAULT) : k.snsDefault ? (va(da.SNSLOGIN), "none" !== b.snsDefaultCon.style.display && x(c.body, "hasSnsDefault"), t.add("customDisplay", "snslogin", da.SNSLOGIN)) : (t.add("customDisplay", "snsdefault", da.DEFAULT), va(da.SNSDEFAULT));
    t.add("customDisplay", Hb);
    var Ib = s("lsrp_appName");
    Ib && Tb(Ib);
    Ajax({
        url: k.infoUrl,
        data: {
            _locale: k.locale
        },
        success: function(a, d) {
            t.add("siteInfo", a);
            var e = n(a),
                e = e[k.locale] || e[JSP_VAR.locale] || [],
                g = c.createElement("div"),
                h = "";
            u(e, function(a, b) {
                h += '<p class="site_info_txt">' + (a.url ? '<a href="' + a.url + '" class="site_info_link" target="_blank">' : "") + a.txt + (a.url ? "</a>" : "") + "</p>"
            });
            x(g, "site_info");
            g.innerHTML = h;
            b.header.parentNode.appendChild(g)
        }
    });
    w(b.codeSelector, D.click, function(a) {
        if (l.enableCode) {
            l.codeInit || (l.codeInit = !0, Ub());
            H.clean(b.userName);
            a = a || d.event;
            var c = a.target || a.srcElement;
            if (G(c, "countrycode_selector") || G(c, "countrycode-value") || G(c, "country_code") || G(c, "icon_arrow_down")) {
                l.codeShown ? (y(b.codeContainer), l.codeShown = !1) : (A(b.codeContainer, !0), b.searchCodeInput && T(b.searchCodeInput, "focus"), l.codeShown = !0)
            }
            "cancelBubble" in a && (a.cancelBubble = !0);
            "stopPropagation" in a && a.stopPropagation();
            return !1
        }
    });
    w(b.body, D.click, function(a) {
        ia();
        "cancelBubble" in a && (a.cancelBubble = !0);
        "stopPropagation" in a && a.stopPropagation()
    });
    w(b.codeContainer, D.click, function(a) {
        a = a || d.event;
        var b = a.target || a.srcElement;
        G(b, "record") ? (rb(b), ia()) : G(b, "record-country") || G(b, "record-code") ? (rb(b.parentNode), ia()) : G(b, "search-code") || G(b, "search-code-input") || ia();
        "cancelBubble" in a && (a.cancelBubble = !0);
        "stopPropagation" in a && a.stopPropagation()
    });
    w(b.navTabs, D.click, function(a) {
        a = a || d.event;
        a = a.target || a.srcElement;
        G(a, "navtab-link") && (a = a.getAttribute("data-tab"), Vb(a))
    });
    var ya = parseInt(s("_userId"), 10) || 0,
        Cc = parseInt(J("userId"), 10),
        Jb = z(J("userName")),
        za = z(decodeURIComponent(s("_userName")));
    ya && (l.verifyPwd = !0, za || (za = ya, Cc === ya && Jb && (za = Jb)), t.add("verifyPwd", ya, za), b.userName.value = ya, b.pwd.value = "", y(b.changeLoginType), y(b.userName.parentNode), A(b.accountInfo, !0), x(b.pwd.parentNode, "accinfo_single_label"), y(b.qrTrigger), b.accountDisplayname.innerHTML = za, b.header.innerHTML = E.VERIFY_PASSWORD, b.loginButton.value = E.VERIFY_PASSWORD_SUBMIT, b.accountDisplayname.style.fontSize = "20px", b.accountDisplayname.style.paddingBottom = "20px", y(g("#custom_display_" + da.SNSLOGIN)));
    w(b.manualCode, D.click, function(a) {
        a = a || d.event;
        l.showCodeValue && (l.showCodeValue = !1, l.manualControlCode = !0, C(b.regionCode, "add_regioncode"), x(b.manualCode.parentNode, "turn_off"), x(b.regionCode, "divflex"), t.add("manualCode", l.showCodeValue, l.manualControlCode));
        ia();
        "cancelBubble" in a && (a.cancelBubble = !0);
        "stopPropagation" in a && a.stopPropagation()
    });
    var Ha = !0;
    if (scopes) {
        var qa = c.createElement("div");
        qa.innerHTML = k.oauthTpl;
        b.layout.appendChild(qa);
        scopes = r(scopes);
        b.scopeList = g(".scope_list", qa)[0];
        b.OAuthBox = qa;
        b.OAuthWrap = g(".oauth_wrap", qa)[0];
        b.OAuthWrapText = g(".wrap_more", qa)[0];
        S = _htmlMore = "";
        for (P = 0; P < scopes.length; P++) {
            P < k.oauthInitNum ? S += '<p class="scope_item"><i class="icon_select icon_true disabled"></i>' + scopes[P].name + "</p>" : _htmlMore += '<p class="scope_item"><i class="icon_select icon_true disabled"></i>' + scopes[P].name + "</p>"
        }
        b.scopeList.innerHTML = S + '<div class="scope_more scope-more">' + _htmlMore + "</div>";
        scopes.length > k.oauthInitNum && A(b.OAuthWrap, !0);
        w(b.OAuthWrap, "click", function() {
            Ha = !Ha;
            b.OAuthWrapText.innerText = Ha ? "More" : "Hide";
            Ha ? (C(b.OAuthWrap, "up"), y(g(".scope-more")[0])) : (x(b.OAuthWrap, "up"), A(g(".scope-more")[0], !0))
        })
    }
    if (b.recordLink && k.beianRecordLink) {
        b.recordLink.href = k.beianRecordLink;
        var la = new Image,
            Dc = g("span", b.recordLink)[0];
        la.onload = la.oncomplete = function() {
            la._loaded = !0;
            Dc.appendChild(la)
        };
        setTimeout(function() {
            !la._loaded && (la.src = k.default1px_gif)
        }, 1000);
        la.src = k.beianRecordImg
    }
    if (W) {
        Y = c.createElement("div");
        Y.id = "cookie-usage-notify";
        Y.className = "cookie_usage_notify";
        Y.innerHTML = k.cookieUsageTpl;
        B(Y, b.footer);
        b.cookieUsage = g("#cookie-usage-notify");
        var Ec = g(".close-cookie-usage", b.cookieUsage)[0],
            Kb = null;
        d.localStorage ? "true" !== localStorage.getItem("COOKIE_USAGE") && A(b.cookieUsage, !0) : A(b.cookieUsage, !0);
        w(Ec, D.click, function(a) {
            a = a || d.event;
            clearTimeout(Kb);
            y(b.cookieUsage);
            d.localStorage && localStorage.setItem("COOKIE_USAGE", !0);
            "cancelBubble" in a && (a.cancelBubble = !0);
            "stopPropagation" in a && a.stopPropagation()
        });
        Kb = setTimeout(function() {
            y(b.cookieUsage)
        }, 20000)
    }
    var X;
    if (k.useManMachine) {
        try {
            (function() {
                initMiverify({
                    k: "8027422fb0eb42fbac1b521ec4a7961f",
                    locale: JSP_VAR.locale,
                    bindBtn: "",
                    errorAction: !0,
                    onSuccess: function(a) {
                        F("vToken", a.flag, 1, "/", ".account.xiaomi.com", 86400);
                        F("vAction", (k.zoneDic[JSP_VAR.dataCenterZone] || "en") + "-" + l.loginType + "-login", 1, "/", ".account.xiaomi.com", 86400);
                        Cb()
                    },
                    onError: function(a) {
                        a.exception && (l.useManMachineError = !0, Cb())
                    },
                    onClose: function(a, b) {
                        b ? K({
                            biz: "loginGeetestClose",
                            type: k.tickType,
                            step: "close"
                        }) : K({
                            biz: "loginUserMachineError",
                            type: k.tickType,
                            step: "machineError"
                        })
                    }
                }, function(a) {
                    X = a
                })
            })()
        } catch (Fc) {
            throw Error(Fc)
        }
    }
    Ua && Ua.loaded && Ua.loaded()
})(window, document);