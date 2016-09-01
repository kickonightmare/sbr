function removeString(s, r) {
    var v = s.split(r);
    var rt = '';
    if (v[0]) {
        rt += '' + v[0];
    }
    if (v[1]) {
        rt += '' + v[1];

    }
    return rt;
}
function str_replace(search, replace, subject, count) {
    var i = 0,
            j = 0,
            temp = '',
            repl = '',
            sl = 0,
            fl = 0,
            f = [].concat(search),
            r = [].concat(replace),
            s = subject,
            ra = Object.prototype.toString.call(r) === '[object Array]',
            sa = Object.prototype.toString.call(s) === '[object Array]';
    s = [].concat(s);
    if (count) {
        this.window[count] = 0;
    }

    for (i = 0, sl = s.length; i < sl; i++) {
        if (s[i] === '') {
            continue;
        }
        for (j = 0, fl = f.length; j < fl; j++) {
            temp = s[i] + '';
            repl = ra ? (r[j] !== undefined ? r[j] : '') : r[0];
            s[i] = (temp)
                    .split(f[j])
                    .join(repl);
            if (count && s[i] !== temp) {
                this.window[count] += (temp.length - s[i].length) / f[j].length;
            }
        }
    }
    return sa ? s : s[0];
}
function base64_encode(data) {
    var b64 = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=';
    var o1, o2, o3, h1, h2, h3, h4, bits, i = 0,
            ac = 0,
            enc = '',
            tmp_arr = [];
    if (!data) {
        return data;
    }
    do { // pack three octets into four hexets
        o1 = data.charCodeAt(i++);
        o2 = data.charCodeAt(i++);
        o3 = data.charCodeAt(i++);

        bits = o1 << 16 | o2 << 8 | o3;

        h1 = bits >> 18 & 0x3f;
        h2 = bits >> 12 & 0x3f;
        h3 = bits >> 6 & 0x3f;
        h4 = bits & 0x3f;

        // use hexets to index into b64, and append result to encoded string
        tmp_arr[ac++] = b64.charAt(h1) + b64.charAt(h2) + b64.charAt(h3) + b64.charAt(h4);
    } while (i < data.length);
    enc = tmp_arr.join('');
    var r = data.length % 3;
    return (r ? enc.slice(0, r - 3) : enc) + '==='.slice(r || 3);
}
function base64_decode(data) {
    var b64 = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=';
    var o1, o2, o3, h1, h2, h3, h4, bits, i = 0,
            ac = 0,
            dec = '',
            tmp_arr = [];

    if (!data) {
        return data;
    }
    data += '';
    do {
        h1 = b64.indexOf(data.charAt(i++));
        h2 = b64.indexOf(data.charAt(i++));
        h3 = b64.indexOf(data.charAt(i++));
        h4 = b64.indexOf(data.charAt(i++));
        bits = h1 << 18 | h2 << 12 | h3 << 6 | h4;
        o1 = bits >> 16 & 0xff;
        o2 = bits >> 8 & 0xff;
        o3 = bits & 0xff;
        if (h3 == 64) {
            tmp_arr[ac++] = String.fromCharCode(o1);
        } else if (h4 == 64) {
            tmp_arr[ac++] = String.fromCharCode(o1, o2);
        } else {
            tmp_arr[ac++] = String.fromCharCode(o1, o2, o3);
        }
    } while (i < data.length);
    dec = tmp_arr.join('');
    return dec.replace(/\0+$/, '');
}
function ucfirst(str) {
    str += '';
    var f = str.charAt(0)
            .toUpperCase();
    return f + str.substr(1);
}
function strrpos(haystack, needle, offset) {
    var i = -1;
    if (offset) {
        i = (haystack + '')
                .slice(offset)
                .lastIndexOf(needle);
        if (i !== -1) {
            i += offset;
        }
    } else {
        i = (haystack + '')
                .lastIndexOf(needle);
    }
    return i >= 0 ? i : false;
}
function number_format(number, decimals, dec_point, thousands_sep) {
    number = (number + '')
            .replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function (n, prec) {
                var k = Math.pow(10, prec);
                return '' + (Math.round(n * k) / k)
                        .toFixed(prec);
            };
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
            .split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '')
            .length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1)
                .join('0');
    }
    return s.join(dec);
}



function m(v, cifrao, separacaoMilhar, separacaoDecimal) {
    if (!cifrao) {
        cifrao = 'R$';
    }
    if (!separacaoMilhar) {
        separacaoMilhar = '.';
    }
    if (!separacaoDecimal) {
        separacaoDecimal = ',';
    }
    if (v && v > 0) {
        var n = number_format(v, 2, separacaoDecimal, separacaoMilhar);
        if (n) {
            return cifrao + ' ' + n;
        } else {
            return cifrao + ' ' + n;
        }
    } else {
        return cifrao + ' 0,00';
    }
}
function d(v) {
    if (v) {
        if (strrpos(v, '.') > 0) {
            v = str_replace('.', '', v);
        }
        if (strrpos(v, ',') > 0) {
            v = str_replace(',', '.', v);
        }
        v = str_replace('R', '', v);
        v = str_replace('$', '', v);
        v = str_replace(' ', '', v);
        v = str_replace('#', '', v);
        v = parseFloat(v);
        return v;
    }
    return 0;
}












var jan = 0;
function janela(url, target) {

    jan++;
    var id = jan;

    var dados = '';
    if (url.indexOf("?")) {
        var u = url.split("?");
        url = u[0];
        dados = u[1];
    }


    $.ajax({
        url: url,
        type: 'POST',
        data: dados,
        beforeSend: function () {
            if (!car) {
                carregando();
            }
            if (!esc) {
                escuro();
            }
        },
        success: function (response) {
            var r = '';
            r = '<div class="janelaTitulo"></div>';
            r += '<div class="janelaConteudo">' + response + '</div>';
            $(target).append('<div id="janela_' + id + '" class="janela"><i id="janelaFechar_' + id + '" class="janelaFechar glyphicon glyphicon-remove"></i>' + r + '</div>');
        },
        complete: function () {
            $('#janela_' + id).fadeIn();
            $(".janelaFechar").click(function () {
                $(".janela").fadeOut();
//                if (esc) {
//                    escuro();
//                }
            });
            if (car) {
                carregando();
            }
            if (esc) {
                escuro();
            }
        }
    });
}
function palavra(s) {
    return s;
}
function post(t, url) {
    if (!url) {
        url = base + 'ajax/post.php';
    }
    $.ajax({
        url: url,
        type: 'POST',
        data: $(t).serialize(),
        beforeSend: function () {
            $("#texto_carregando").html('Salvando...');
            if (!car) {
                carregando();
            }
            if (!esc) {
                escuro();
            }
        },
        success: function (r) {
            $("#texto_carregando").html('Carregando...');
            $('#ajax').html(r);
        },
        complete: function () {
            if (car) {
                carregando();
            }
            if (esc) {
                escuro();
            }
            $("#myModal").modal('hide');
//            window.location = '';
        }
    });
}





function atualizaContador(t, YY, MM, DD, HH, MI, SS) {
    var hoje = new Date();
    var futuro = new Date(YY, MM, DD, HH, MI, SS);
    var ss = parseInt((futuro - hoje) / 1000);
    var mm = parseInt(ss / 60);
    var hh = parseInt(mm / 60);
    var dd = parseInt(hh / 24);
    ss = ss - (mm * 60);
    mm = mm - (hh * 60);
    hh = hh - (dd * 24);

    DD = dd;
    HH = hh;
    MI = mm;
    SS = ss;

    var faltam = '';
    faltam += (dd && dd > 1) ? dd + ' dias, ' : (dd == 1 ? '1 dia, ' : '');
    faltam += (toString(hh).length) ? hh + ' horas, ' : '';
    faltam += (toString(mm).length) ? mm + ' minutos e ' : '';
    faltam += ss + ' segundos';
    if (dd + hh + mm + ss > 0) {
        $(t).html(faltam);
    } else {
        $(t).html('Chegou');
    }
    setTimeout(atualizaContador(t, YY, MM, DD, HH, MI, SS), 1000);
}


function toggleDiv(i) {
    $(i + 'Feedback').fadeOut();
    if (!cache['toggle' + i]) {
        cache['toggle' + i] = true;
        $(i).fadeIn();
        $(i).find('[name=nome]').focus();
    } else {
        cache['toggle' + i] = false;
        $(i).fadeOut();
    }
}


function rand(min, max) {
    var argc = arguments.length;
    if (argc === 0) {
        min = 0;
        max = 2147483647;
    } else if (argc === 1) {
        throw new Error('Warning: rand() expects exactly 2 parameters, 1 given');
    }
    return Math.floor(Math.random() * (max - min + 1)) + min;
}



function centro(t) {
    $(t).css({
        left: (($(window).width() / 2) - ($(t).width() / 2)),
        top: (($(window).height() / 2) - ($(t).height() / 2)) - 30
    });
}
function fadeOut(t) {
    var time = 0;
    $(t).each(function () {
        time += 100;
        var $this = $(this);
        setTimeout(function () {
            $this.fadeOut();
        }, time);
    });
}
function fadeOutRand(t) {
    var time = 0;
    $(t).each(function () {
        time = rand(0, 1000);
        var $this = $(this);
        setTimeout(function () {
            $this.fadeOut();
        }, time);
    });
}
function fadeIn(t) {
    var time = 0;
    $(t).each(function () {
        time += 100;
        var $this = $(this);
        setTimeout(function () {
            $this.fadeIn();
        }, time);
    });
}
function fadeInRand(t) {
    var time = 0;
    $(t).each(function () {
        time = rand(0, 1000);
        var $this = $(this);
        setTimeout(function () {
            $this.fadeIn();
        }, time);
    });
}



var cachePasso = new Array();
var cacheTimeTituloTresPontos = false;
function tituloTresPontos(t, tt, clear) {
    if (clear) {
        if (cacheTimeTituloTresPontos) {
            clearTimeout(cacheTimeTituloTresPontos);
        }
    } else {
        var ddd = '';
        if (!cachePasso[t + tt]) {
            cachePasso[t + tt] = 0;
        }
        if (cachePasso[t + tt] === 0) {
            cachePasso[t + tt] = 1;
            ddd = ' ...';
        } else
        if (cachePasso[t + tt] === 1) {
            cachePasso[t + tt] = 2;
            ddd = ' .&nbsp;&nbsp;';
        } else
        if (cachePasso[t + tt] === 2) {
            cachePasso[t + tt] = 0;
            ddd = ' ..&nbsp;';
        }
        $(t).html(tt + ddd);
        if (cacheTimeTituloTresPontos) {
            clearTimeout(cacheTimeTituloTresPontos);
        }
        cacheTimeTituloTresPontos = setTimeout(function () {
            tituloTresPontos(t, tt);
        }, 500);
    }
}


function removerAcentos(newStringComAcento) {
    var string = newStringComAcento;
    var mapaAcentosHex = {
        a: /[\xE0-\xE6]/g,
        e: /[\xE8-\xEB]/g,
        i: /[\xEC-\xEF]/g,
        o: /[\xF2-\xF6]/g,
        u: /[\xF9-\xFC]/g,
        c: /\xE7/g,
        n: /\xF1/g
    };

    for (var letra in mapaAcentosHex) {
        var expressaoRegular = mapaAcentosHex[letra];
        string = string.replace(expressaoRegular, letra);
    }

    return string;
}


function print_r(array, return_val) {
    //  discuss at: http://phpjs.org/functions/print_r/
    //        http: //kevin.vanzonneveld.net
    // original by: Michael White (http://getsprink.com)
    // improved by: Ben Bryan
    // improved by: Brett Zamir (http://brett-zamir.me)
    // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    //    input by: Brett Zamir (http://brett-zamir.me)
    //  depends on: echo
    //   example 1: print_r(1, true);
    //   returns 1: 1

    var output = '',
            pad_char = ' ',
            pad_val = 4,
            d = this.window.document,
            getFuncName = function (fn) {
                var name = (/\W*function\s+([\w\$]+)\s*\(/)
                        .exec(fn);
                if (!name) {
                    return '(Anonymous)';
                }
                return name[1];
            };
    repeat_char = function (len, pad_char) {
        var str = '';
        for (var i = 0; i < len; i++) {
            str += pad_char;
        }
        return str;
    };
    formatArray = function (obj, cur_depth, pad_val, pad_char) {
        if (cur_depth > 0) {
            cur_depth++;
        }

        var base_pad = repeat_char(pad_val * cur_depth, pad_char);
        var thick_pad = repeat_char(pad_val * (cur_depth + 1), pad_char);
        var str = '';

        if (typeof obj === 'object' && obj !== null && obj.constructor && getFuncName(obj.constructor) !==
                'PHPJS_Resource') {
            str += 'Array\n' + base_pad + '(\n';
            for (var key in obj) {
                if (Object.prototype.toString.call(obj[key]) === '[object Array]') {
                    str += thick_pad + '[' + key + '] => ' + formatArray(obj[key], cur_depth + 1, pad_val, pad_char);
                } else {
                    str += thick_pad + '[' + key + '] => ' + obj[key] + '\n';
                }
            }
            str += base_pad + ')\n';
        } else if (obj === null || obj === undefined) {
            str = '';
        } else { // for our "resource" class
            str = obj.toString();
        }

        return str;
    };

    output = formatArray(array, 0, pad_val, pad_char);

    if (return_val !== true) {
        if (d.body) {
            this.echo(output);
        } else {
            try {
                d = XULDocument; // We're in XUL, so appending as plain text won't work; trigger an error out of XUL
                this.echo('<pre xmlns="http://www.w3.org/1999/xhtml" style="white-space:pre;">' + output + '</pre>');
            } catch (e) {
                this.echo(output); // Outputting as plain text may work in some plain XML
            }
        }
        return true;
    }
    return output;
}


function equalize(t) {
    var h = 0;
    $(t).each(function () {
        if (h < $(this).height()) {
            h = $(this).height();
        }
    }).height(h);
}