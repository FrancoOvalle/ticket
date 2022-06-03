<div id="anychart-embed-src-pie-and-donut-charts-donut-chart" class="anychart-embed anychart-embed-src-pie-and-donut-charts-donut-chart">
<script src="https://cdn.anychart.com/releases/v8/js/anychart-base.min.js"></script>
<script src="https://cdn.anychart.com/releases/v8/js/anychart-ui.min.js"></script>
<script src="https://cdn.anychart.com/releases/v8/js/anychart-exports.min.js"></script>
<script src="https://cdn.anychart.com/releases/v8/locales/es-cl.js"></script>
<script src="https://cdn.anychart.com/releases/v8/geodata/countries/chile/chile.js"></script>
<script src="https://cdn.anychart.com/releases/v8/themes/morning.js"></script>
<div id="ac_style_src-pie-and-donut-charts-donut-chart" style="display:none;">
html,
body,
#container {
  width: 100%;
  height: 100%;
  margin: 0;
  padding: 0;
}
</div>
<script>(function(){
function ac_add_to_head(el){
	var head = document.getElementsByTagName('head')[0];
	head.insertBefore(el,head.firstChild);
}
function ac_add_link(url){
	var el = document.createElement('link');
	el.rel='stylesheet';el.type='text/css';el.media='all';el.href=url;
	ac_add_to_head(el);
}
function ac_add_style(css){
	var ac_style = document.createElement('style');
	if (ac_style.styleSheet) ac_style.styleSheet.cssText = css;
	else ac_style.appendChild(document.createTextNode(css));
	ac_add_to_head(ac_style);
}
ac_add_link('https://cdn.anychart.com/releases/v8/css/anychart-ui.min.css');
ac_add_link('https://cdn.anychart.com/releases/v8/fonts/css/anychart-font.min.css');
ac_add_style(document.getElementById("ac_style_src-pie-and-donut-charts-donut-chart").innerHTML);
ac_add_style(".anychart-embed-src-pie-and-donut-charts-donut-chart{width:600px;height:450px;}");
})();</script>
<div id="container"></div>
<script>
anychart.onDocumentReady(function () {
  // create pie chart with passed data
  var chart = anychart.pie([
    ['Pendientes', 3],
    ['En Desarrollo', 3],
    ['Cancelados', 4],
    ['Terminados',31]
    
  ]);

  // set chart title text settings
  chart
    .title('Reportes Tickets')
    // set chart radius
    .radius('43%')
    // create empty area in pie chart
    .innerRadius('30%');

  // set container id for the chart
  chart.container('container');
  // initiate chart drawing
  chart.draw();
});
</script>
</div>