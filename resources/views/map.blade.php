
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Peta</title>

	<link rel="shortcut icon" type="image/x-icon" href="docs/images/favicon.ico" />

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>

	<style>
		html, body {
			height: 100%;
			margin: 0;
		}
		.leaflet-container {
			height: 400px;
			width: 600px;
			max-width: 100%;
			max-height: 100%;
		}
	</style>

<style>body { padding: 0; margin: 0; } #map { height: 100%; width: 100vw; }</style>
</head>
<body>
    <div><center><h1>Peta Sebaran Penerima Rantang Kasih</h1></center>
    </div>
<div class="row" id="map">
    {{-- <div><h1>Peta Sebaran Penerima Rantang Kasih</h1></div> --}}
    {{-- <div id="map"></div> --}}
</div>
<script>
	var map = L.map('map').fitWorld().setView([0.136299, 117.47921], 13);
	var tiles = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
		maxZoom: 18,
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
			'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		id: 'mapbox/streets-v11',
		tileSize: 512,
		zoomOffset: -1
	}).addTo(map);
	var marker = L.marker([0.17473, 117.466164]).addTo(map)
	var marker = L.marker([0.10967, 117.453632]).addTo(map)
	var marker = L.marker([0.131299, 117.507019]).addTo(map)
	var marker = L.marker([0.094221, 117.457066]).addTo(map)
	var marker = L.marker([0.07551, 117.46891]).addTo(map)
		.bindPopup('<b>Hello world!</b><br />I am a popup.').openPopup();
	var circle = L.circle([ 0.136299, 117.47921], {
		color: 'red',
		fillColor: '#f03',
		fillOpacity: 0.5,
		radius: 1000
	}).addTo(map).bindPopup('I am a circle.');
	var polygon = L.polygon([
		[
        0.1889988,117.4905396

        ],
        [
            0.1886555,117.47612

        ],
        [
            0.1864239,117.4438477

        ],
        [
            0.1716611,117.4390411

        ],
        [
            0.1680562,117.4407578

        ],
        [
            0.1663396,117.4361229

        ],
        [
            0.1412772,117.4280548

        ],
        [
            0.1364707,117.4259949

        ],
        [
            0.1323508,117.4191284

        ],
        [
            0.1241111,117.4141502

        ],
        [
            0.1201629,117.4134636

        ],
        [
            0.1163863,117.4105453

        ],
        [
            0.1138114,117.4086571

        ],
        [
            0.1088332,117.4067688

        ],
        [
            0.1066017,117.4026489

        ],
        [
            0.1033401,117.3976707

        ],
        [
            0.0992202,117.3940659

        ],
        [
            0.0454903,117.4687386

        ],
        [
            0.0527,117.4742317

        ],
        [
            0.0592232,117.4733734

        ],
        [
            0.0629997,117.4780083

        ],
        [
            0.0667763,117.4711418

        ],
        [
            0.0710678,117.4785233

        ],
        [
            0.0781059,117.4785233

        ],
        [
            0.0784492,117.4749184

        ],
        [
            0.0825691,117.4908829

        ],
        [
            0.0892639,117.4931145

        ],
        [
            0.0949287,117.4938011

        ],
        [
            0.0971603,117.5008392

        ],
        [
            0.1014518,117.5039291

        ],
        [
            0.1088332,117.4941444

        ],
        [
            0.1096916,117.5044441

        ],
        [
            0.1052284,117.5056458

        ],
        [
            0.10746,117.5102806

        ],
        [
            0.1122665,117.5150871

        ],
        [
            0.1134681,117.5343132

        ],
        [
            0.1239394,117.5353432

        ],
        [
            0.1337241,117.5353432

        ],
        [
            0.1419638,117.5289917

        ],
        [
            0.1490019,117.5252151

        ],
        [
            0.1539801,117.5236702

        ],
        [
            0.1572416,117.5159454

        ],
        [
            0.1589582,117.508049

        ],
        [
            0.1617048,117.5061607

        ],
        [
            0.1543234,117.4998093

        ],
        [
            0.147457,117.4943161

        ],
        [
            0.1496886,117.4932861

        ],
        [
            0.1575849,117.4970627

        ],
        [
            0.1608465,117.4962044

        ],
        [
            0.1593016,117.4908829

        ],
        [
            0.1541517,117.4900246

        ],
        [
            0.1505469,117.4903679

        ],
        [
            0.1490448,117.4881792

        ],
        [
            0.1495598,117.487278

        ],
        [
            0.1519201,117.4889088

        ],
        [
            0.1557825,117.48878

        ],
        [
            0.1586149,117.4885225

        ],
        [
            0.1601169,117.4874926

        ],
        [
            0.1596449,117.4855185

        ],
        [
            0.1584003,117.4844885

        ],
        [
            0.1567266,117.4838877

        ],
        [
            0.1558254,117.482729

        ],
        [
            0.1565121,117.4785233

        ],
        [
            0.1608465,117.4802828

        ],
        [
            0.1622198,117.4792957

        ],
        [
            0.1630352,117.476635

        ],
        [
            0.1641081,117.4770641

        ],
        [
            0.1649664,117.4777508

        ],
        [
            0.1642368,117.4789095

        ],
        [
            0.1644085,117.480669

        ],
        [
            0.1651809,117.4821711

        ],
        [
            0.1644085,117.4829006

        ],
        [
            0.1626489,117.4805403

        ],
        [
            0.1602457,117.4822998

        ],
        [
            0.1617477,117.4849176

        ],
        [
            0.1632927,117.4838877

        ],
        [
            0.164328,117.4854702

        ],
        [
            0.1645318,117.485497

        ],
        [
            0.1652507,117.4850303

        ],
        [
            0.1654921,117.4852771

        ],
        [
            0.1651648,117.4854487

        ],
        [
            0.1645479,117.4855989

        ],
        [
            0.1645479,117.4859262

        ],
        [
            0.1651541,117.4865377

        ],
        [
            0.1649181,117.4867362

        ],
        [
            0.1651005,117.4869561

        ],
        [
            0.1644138,117.4875838

        ],
        [
            0.1645962,117.4877447

        ],
        [
            0.1645962,117.4877447

        ],
        [
            0.1653687,117.4871922

        ],
        [
            0.1667795,117.4888229

        ],
        [
            0.1666079,117.4897242

        ],
        [
            0.170599,117.4906683

        ],
        [
            0.1725194,117.485733

        ],
        [
            0.173485,117.4857223

        ],
        [
            0.1734206,117.4861407

        ],
        [
            0.1760116,117.4860656

        ],
        [
            0.1761297,117.4857277

        ],
        [
            0.1765052,117.4857008

        ],
        [
            0.1764837,117.4855131

        ],
        [
            0.1768807,117.485556

        ],
        [
            0.1772669,117.4859959

        ],
        [
            0.1794502,117.4848425

        ],
        [
            0.1795414,117.4850357

        ],
        [
            0.1790801,117.4852288

        ],
        [
            0.1787046,117.4855399

        ],
        [
            0.1780179,117.4858886

        ],
        [
            0.1774547,117.4863499

        ],
        [
            0.1770738,117.4867469

        ],
        [
            0.17665,117.4869829

        ],
        [
            0.1764247,117.4877286

        ],
        [
            0.1760385,117.4882543

        ],
        [
            0.1758775,117.4881577

        ],
        [
            0.1757488,117.4883777

        ],
        [
            0.1758239,117.4884689

        ],
        [
            0.17503,117.4896008

        ],
        [
            0.1758132,117.4902445

        ],
        [
            0.1773366,117.4896169

        ],
        [
            0.1777604,117.4895632

        ],
        [
            0.178549,117.4882543

        ],
        [
            0.179697,117.4889678

        ],
        [
            0.1791713,117.4899012

        ],
        [
            0.1792732,117.4900299

        ],
        [
            0.1787904,117.4907917

        ],
        [
            0.1783344,117.4904859

        ],
        [
            0.1778838,117.490443

        ],
        [
            0.177621,117.4905235

        ],
        [
            0.1772615,117.4907756

        ],
        [
            0.1764462,117.4911779

        ],
        [
            0.1744828,117.4918967

        ],
        [
            0.1737103,117.4931413

        ],
        [
            0.1738069,117.4937367

        ],
        [
            0.173823,117.4947613

        ],
        [
            0.1733603,117.4947721

        ],
        [
            0.1733576,117.4948338

        ],
        [
            0.1738096,117.4948177

        ],
        [
            0.1738122,117.4952039

        ],
        [
            0.1734609,117.4952039

        ],
        [
            0.1734662,117.4952683

        ],
        [
            0.1738203,117.4952522

        ],
        [
            0.1738069,117.4987578

        ],
        [
            0.1736567,117.4999595

        ],
        [
            0.1755664,117.5044441

        ],
        [
            0.1790854,117.5033498

        ],
        [
            0.1797935,117.5007749

        ],
        [
            0.1787421,117.4986291

        ],
        [
            0.1796648,117.4974275

        ],
        [
            0.1815531,117.4965477

        ],
        [
            0.1802012,117.4932647

        ],
        [
            0.1889982,117.4905409

        ]
	]).addTo(map);
    function onMapClick(e) {
        popup
            .setLatLng(e.latlng)
            .setContent('You clicked the map at ' + e.latlng.toString())
            .openOn(map);
    }
	var popup = L.popup()
		.setLatLng([0.136299, 117.47921])
		.setContent('Kota Bontang.')
		.openOn(map);
	map.on('click', onMapClick);
</script>
</body>
</html>
