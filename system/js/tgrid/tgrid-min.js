TGrid=function(c,d,b){this.Esq=c;this.Div=d;this.Titulo=b;this.Exel=false;this.Enu=false;this.Paginador=0;this.Tipo_Origen="";this.GetName=null;this.Detalle=0;this.SetXls=function(e){this.Exel=e};this.GetXls=function(){alert(this.Exel)};this.SetNumeracion=function(e){this.Enu=e};this.GetNumeracion=function(){alert(this.Enu)};this.SetName=function(e){this.GetName=e};this.SetPaginador=function(e){this.Paginador=e};this.GetPaginador=function(){alert(this.Pagainador)};this.Cargar=function(){return false};this.Origen=function(){if(this.Esq.Origen=="json"){this.Tipo_Origen="json";this.Generar_Json()}else{this.Tipo_Origen="mysql";this.Generar_Mysql()}};this.Generar_Json=function(){var z=this.Detalle;var u=this.Exel;var q=this.Enu;var f=this.Esq;var l=f.Paginador;var y=0;var S=0;var C="";$("#"+this.Div).html("");var N=document.getElementById(this.Div);var r=document.createElement("div");r.id="div_superior"+this.GetName;N.appendChild(r);var I=document.createElement("div");I.id="div_medio"+this.GetName;I.style.cssText="OVERFLOW: auto;height:100%;";N.appendChild(I);var j=document.createElement("div");N.appendChild(j);var s=document.createElement("div");s.id="div_inferior"+this.GetName;N.appendChild(s);var m=document.createElement("table");m.id="tabla_tgrid"+this.GetName;m.className="TGrid";m.style.width="100%";I.appendChild(m);var t=this.GetName;if(u==true){var A=document.createElement("button");A.innerHTML="Generar XLS";A.onclick=function(){Genera_Xls_Json(t,f.Cabezera)};N.appendChild(A)}var w=new Array();var B=new Array();var i=new Array();var F=new Array();var h=0;var R="";var P=m.createTHead();var g=P.insertRow(0);var D=document.createElement("th");var H=0;var v=document.createElement("tBody");v.id=m.id+"tbody";var o="";if(q==true){m.style.emptyCells="inherit";D.id="T_enumera"+t;g.appendChild(D);var G=document.createElement("th")}var e=false;$.each(f.Cabezera,function(X,T){var k=document.createElement("th");k.id="T"+X+t;k.style.cssText=T.atributos;g.appendChild(k);k.innerHTML=T.titulo;if(T.buscar!=null){var W=document.createElement("input");var U=h+1-1;W.type="text";W.id="F"+X+t;W.style.display="none";k.onclick=function(){Muestra_Filtro(W);$("#"+W.id).focus()};W.onkeyup=function(){filtra(this.value,m,U)};W.onblur=function(){Oculta_Filtro(W)};k.appendChild(W)}if(T.oculto!=null){var U=h*1;w.push(U);k.style.display="none"}if(T.total!=null){var V=h+1;i.push(V);F[V]=0;e=true}h++;B[X]="";R=T.tipo;if(R!=null){switch(R){case"boton":var aa=document.createElement("input");aa.type="button";aa.style.width="100%";B[X]=aa;break;case"bimagen":var aa=document.createElement("input");aa.type="image";aa.src=T.ruta;B[X]=aa;break;case"detalle":var aa=document.createElement("input");aa.type="image";aa.src=T.ruta;B[X]=aa;z=1;break;case"checkbox":var Y=f.Objetos[X];if(Y.length==1){var aa=document.createElement("input");aa.type="checkbox";aa.value=f.Objetos[X][0].valor;B[X]=aa}break;case"radio":var Z=document.createElement("th");Z.id="T"+X+"_";Z.innerHTML=T.titulo1;Z.style.cssText=T.atributos;g.appendChild(Z);var aa=document.createElement("input");aa.type="radio";aa.value=1;B[X]=aa;break;default:B[X]=R;break}}});m.appendChild(v);$.each(f.Cuerpo,function(T,U){var W=v.insertRow(v.rows.length);W.id=T+"_"+t;H++;if(z==1){var V=v.insertRow(v.rows.length);V.id=T+"_"+t+"_Detalle";var k=V.insertCell(V.cells.length);k.id=V.id+"0";k.colSpan=g.cells.length-1;k.style.display="none"}if(q==true){th_nuevo=G.cloneNode(true);th_nuevo.innerHTML=T;W.appendChild(th_nuevo)}$.each(U,function(aa,ab){o=T+"_"+aa+"_"+t;var ac=W.insertCell(W.cells.length);if(e==true){for(var ad=0;ad<i.length;ad++){if(i[ad]==aa){pos_Total=i[ad];F[pos_Total]+=(ab*1)}}}ac.id=o;if(B[aa]!=""){if(typeof B[aa]!="string"){var af=B[aa].cloneNode(true);af.id=o+"_0";switch(af.type){case"button":af.value=ab;af.onclick=function(){Ejecutar(f.Cabezera[aa].funcion,W.id,f.Cabezera[aa].parametro,m.id)};var X=document.createElement("div");X.id="div_texto_boton";X.style.cssText="display:none";X.innerHTML=ab;af.appendChild(X);ac.appendChild(af);break;case"image":if(f.Cabezera[aa].funcion=="MuestraDetalle"){k.innerHTML=ab;af.onclick=function(){muestra_detalle(V.id,m.id)}}else{af.onclick=function(){Ejecutar(f.Cabezera[aa].funcion,W.id,f.Cabezera[aa].parametro,m.id)}}var X=document.createElement("div");X.id="div_texto_img";X.style.cssText="display:none";X.innerHTML="sValor";af.appendChild(X);ac.appendChild(af);break;case"checkbox":var ae=f.Objetos[aa];if(ae.length==1){af.value=f.Objetos[aa][0].valor;af.onclick=function(){Revisa_Casilla(f.Objetos[aa][0].etiqueta,T+"_"+aa)};af.innerHTML='<DIV ID ="div_'+o+'" STYLE="display:none"></DIV></TD>';ac.appendChild(af)}break;case"radio":af.name="radio_"+o;var Y=document.createElement("input");Y.type="radio";Y.id=o+"_1";Y.name="radio_"+o;Y.value=0;ac.appendChild(af);var Z=W.insertCell(W.cells.length);ac.id="R"+o;Z.id="R"+o+"_";Z.appendChild(Y);if(ab=="1"){af.checked=true}else{Y.checked=true}break}}else{ac.ondblclick=function(){Crea_Objeto(this,B[aa])};ac.innerHTML=ab}}else{ac.innerHTML=ab}})});for(var Q=0;Q<w.length;Q++){Oculta_Columna(w[Q],m.id)}if(f.Paginador!=null&&f.Paginador!=0){$("#div_inferior"+t).html("");if(m.rows.length>f.Paginador){p=new Paginador(s,m,l,z);p.Mostrar()}}var J=document.createElement("div");J.id="div_titulo"+t;J.className="fondo_titulo";var K=document.createElement("h1");K.className="titulo";K.innerHTML=this.Titulo;J.appendChild(K);var L=document.createElement("div");L.id="dialog_pie"+t;r.appendChild(J);r.appendChild(L);var x=document.createElement("table");x.style.cssText="width:100%; background-color:#4E96BE;";var n=x.insertRow(x.rows.length);for(var O=0;O<i.length;O++){pos_Total=i[O];var M=n.insertCell(n.cells.length);M.style.cssText="text-align:center;color:white;";var E=this.Formato(F[pos_Total]," Bs.");M.innerHTML="El Resultado Total de la columna ( "+pos_Total+" ) es ( <b>"+E+"</b> )"}j.className="totales";j.appendChild(x)};this.Generar_Mysql=function(){var v=this.Enu;oEsquema2=this.Esq;$("#"+this.Div).html("");var u=document.getElementById(this.Div);var l=document.createElement("div");l.id="div_superior"+this.GetName;u.appendChild(l);var i=document.createElement("div");i.id="div_tabla"+this.GetName;i.style.cssText="height:80%;WIDTH: 100%;overflow: auto;";u.appendChild(i);var j=document.createElement("div");j.id="div_inferior"+this.GetName;u.appendChild(j);var m=document.createElement("table");m.id="tabla_tgrid"+this.GetName;m.style.width="100%";m.className="TGrid";i.appendChild(m);var k=0;var f=document.createElement("tBody");m.appendChild(f);var t="";var e=m.createTHead();var q=e.insertRow(0);if(v!=false){m.style.emptyCells="inherit";var n=document.createElement("th");q.appendChild(n);var r=document.createElement("th")}var o=1;$.each(oEsquema2.Cabezera,function(x,w){var y=document.createElement("th");y.id="T"+x;y.style.cssText="position:relative;";q.appendChild(y);y.innerHTML=w;o++});$.each(oEsquema2.Cuerpo,function(w,x){var y=f.insertRow(f.rows.length);y.id=parseInt(w)+1;k++;if(v!=false){th_nuevo=r.cloneNode(true);th_nuevo.innerHTML=k;y.appendChild(th_nuevo)}$.each(x,function(z,A){t=k+"_"+z;var B=y.insertCell(y.cells.length);B.id=t;B.innerHTML=A})});var h=document.createElement("div");h.id="div_titulo";h.style.cssText="color:#000;";var g=document.createElement("h1");g.className="titulo";g.innerHTML=this.Titulo;h.appendChild(g);if(oEsquema2.Paginador!=null&&oEsquema2.Paginador!=0){$("#div_inferior").html("");if(m.rows.length>oEsquema2.Paginador){p=new Paginador(j,m,oEsquema2.Paginador);p.Mostrar()}}var s=document.createElement("div");s.id="dialog_pie";l.appendChild(h);l.appendChild(s)};this.Formato=function(f,i){f=Math.round(parseFloat(f)*Math.pow(10,2))/Math.pow(10,2);i=i||"";f+="";var h=f.split(".");var e=h[0];var g=h.length>1?"."+h[1]:".00";g=g+"00";g=g.substr(0,3);var j=/(\d+)(\d{3})/;while(j.test(e)){e=e.replace(j,"$1,$2")}return e+g+i};this.Genera_Xls=function(){var f="{ ";var g="{ ";var i=0;var h=0;var e=new Date();$.each(this.Esq.Cuerpo,function(j,k){if(i!=0){f+=","}i++;f+=' " '+j+' " : { ';h=0;$.each(k,function(l,m){if(h!=0){f+=","}h++;f+=' " '+l+' " :  " '+m+' "'});f+="} "});f+="} ";i=0;$.each(this.Esq.Cabezera,function(j,k){if(i!=0){g+=","}i++;g+=' " '+j+' " :  " '+k+' "'});g+="} ";$("#dialog_pie").dialog({modal:true,title:"BAJAR ARCHIVO",hide:"explode",show:"slide",width:350,height:300,buttons:{Cerrar:function(){$(this).dialog("close")}}});$("#dialog_pie").html("<br><br><br><p><center>Cargando por favor espere un momento<br><img src='"+sImg+"cargando.gif'></center></p>");$("#dialog_pie").show();$.ajax({url:sUrl+"/index.php/cooperativa/Exporta_Exel",type:"POST",data:"cuerpo="+f+"&cabezera="+g,success:function(j){$("#dialog_pie").html(j)}})};function a(e,g,f){if(e.addEventListener){e.addEventListener(g,f,false)}else{e.attachEvent("on"+g,f)}}};