/**
 * Created by aleix on 01/02/2017.
 */
(function(d, t, e, m){

        // Async Rating-Widget initialization.
        window.RW_Async_Init = function(){

            RW.init({
                huid: "347212",
                uid: "ca97c079820698cedd2e981de27d86af",
                options: { "style": "oxygen" }
            });
            RW.render();
        };
        // Append Rating-Widget JavaScript library.
        var rw, s = d.getElementsByTagName(e)[0], id = "rw-js",
            l = d.location, ck = "Y" + t.getFullYear() +
                "M" + t.getMonth() + "D" + t.getDate(), p = l.protocol,
            f = ((l.search.indexOf("DBG=") > -1) ? "" : ".min"),
            a = ("https:" == p ? "secure." + m + "js/" : "js." + m);
        if (d.getElementById(id)) return;
        rw = d.createElement(e);
        rw.id = id; rw.async = true; rw.type = "text/javascript";
        rw.src = p + "//" + a + "external" + f + ".js?ck=" + ck;
        s.parentNode.insertBefore(rw, s);
    }(document, new Date(), "script", "rating-widget.com/"));