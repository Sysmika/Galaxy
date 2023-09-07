function gebi(id){return document.getElementById(id);}
function gebc(clase){return document.querySelectorAll('.'+clase);}

function evalJSFromHtml(html) {
  var newElement = document.createElement('div');
  newElement.innerHTML = html;

  var scripts = newElement.getElementsByTagName("script");
  for (var i = 0; i < scripts.length; ++i) {
    var script = scripts[i];
    eval(script.innerHTML);
  }
}

function dynamicallyLoadScript(url) {
    var script = document.createElement("script");  // create a script DOM node
    script.src = url;  // set its src to the provided URL
    document.head.appendChild(script);
    //console.log(script);// add it to the end of the head section of the page (could change 'head' to 'body' to add it to the end of the body section instead)
}

function linkAction (url,options,capa,tipo) {
    event.preventDefault();
    var check = true,
        formElement,
        data;
    if((tipo === 'submit') || (tipo === 'reload')){
            formElement = gebi(options);
            data        = new FormData(formElement);
            //check       = checkCampos(gebi(options));
    }
    else if(tipo === 'redir'){
            formElement = gebi(options);
            data        = new FormData(formElement);
            //check       = checkCampos(gebi("#"+options));
        let style       = document.querySelector('input[name="estilo"]:checked').value;
        document.cookie = "style="+style+"; expires=01 Jan 2970 00:00:00 UTC; path=/;secure";
        let background  = document.querySelector('input[name="fondo"]:checked').value;
        document.cookie = "background="+background+"; expires=01 Jan 2970 00:00:00 UTC; path=/;secure";
    }
    else if((tipo === 'unlink') || (tipo === 'delete')){
            data = new URLSearchParams(options);
    }
    else if(tipo === 'search'){
            data = new URLSearchParams(options);
//console.log(data);
    }
        
    if(check){
            fetch(url, {
               method: 'POST',
              // body: JSON.stringify(options)
               body: data
            })
            .then((response) => response.text())
            .then((html) => {
                if(tipo === 'redir'){
                     window.scrollTo(0, 0);
                     gebi(capa).innerHTML = '<div class="alert alert-info text-center">Realizando los cambios</div>';
                     window.location.href='https://galaxy.orion.com.ar/';
                }else{
                     window.scrollTo(0, 0);
                     dynamicallyLoadScript('js/orion.js');
                     gebi(capa).innerHTML = html;
                     evalJSFromHtml(html);
                    if(tipo === 'reload'){
                        linkAction (url,options,capa,tipo)
                    }else{
                        linkAction (url,options,capa,tipo)
                    }
                     //closeNav();
                     //window.scrollTo = '0 ,50px';
                }
            })
            .catch((error) => {
                console.warn('UPPS '+url+' ||| '+error);
            });
       }else{
          alert('complete los campos obligatorios');
       }
} 

//////////////////////// validacion

    function checkCampos(obj) {
        var camposRellenados = true;
//  console.log(obj[0].elements);
       obj.find("input:required,select:required,textarea:required").each(function () {
            var $this = $(this);
            if (this.val().length <= 0) {
//console.log($this.addClass('has-error'));
// console.log(this);
                this.removeAttr('required').addClass('has-error');
                camposRellenados = false;
                return false;
            }else{
                this.removeClass('has-error').attr('required',true);
            }
        });
        if (camposRellenados == false) {
            return false;
        } else {
            return true;
        }
    }

//////////////////////// Reloj digital

     function digiClock() {
            "use strict";
            var months = [ "Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sept", "Oct", "Nov", "Dec" ];
            var week = [ "Dom", "Lun", "Mar", "Mier", "Jue", "Vie", "Sab" ];
            var crTime = new Date();
            var crYrs = crTime.getFullYear();
            var crWrs = week[ crTime.getDay() ];
            var crMrs = months[ crTime.getMonth() ];
            var crDrs = crTime.getDate();
            var crHrs = crTime.getHours();
            var crMns = crTime.getMinutes();
            var crScs = crTime.getSeconds();
            crMns = ( crMns < 10 ? "0" : "" ) + crMns;
            //crScs = ( crScs < 10 ? "0" : "" ) + crScs;
            var timeOfDay = ( crHrs < 12 ) ? "AM" : "PM";
            crHrs = ( crHrs > 12 ) ? crHrs - 12 : crHrs;
            crHrs = ( crHrs === 0 ) ? 12 : crHrs;
            //var crTimeString = crHrs + ":" + crMns + ":" + crScs + " " + timeOfDay;
            var crTimeString = crWrs + " " + crDrs + " de " + crMrs + " " + crHrs + ":" + crMns + " " + timeOfDay;
            gebi("time").innerHTML=  crTimeString ;
        }

setInterval( 'digiClock()', 1000 );


