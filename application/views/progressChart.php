<?php $this->load->view('./komponen/header');?>

<input id="json-data" type="hidden" value='<?=$json_data?>'>
<input id="customer" type="hidden" value='<?=$nama?>'>
<div class="col-md-1"></div>
<div class="col-md-10">
    <canvas id="line-chart"></canvas>
</div>

<!-- Dibawah ini closing tag container dan row di header.php -->
</div>
</div>
<script src="<?php echo site_url('../assets/js/jquery-3.2.1.min.js')."?".rand() ?>"></script>
<script src="<?php echo site_url('../assets/js/Chart.min.js')."?".rand() ?>"></script>
<script>
    $(function(){

        var json_data = JSON.parse($('#json-data').val());
        $('#json-data').val('');

        var nilai = {
            berat:[],
            lemak_tubuh:[],
            massa_tulang:[],
            kadar_air:[],
            massa_otot:[],
            rating_fisik:[],
            bmr:[],
            usia_sel:[],
            lemak_visceral:[]
        };

        var tanggal = [];

        $.each(json_data, function(index, value){

            switch (value.attribute) {
                case 'Berat':
                    nilai.berat.push(value.nilai);
                    break;
                
                case 'Lemak Tubuh':
                    nilai.lemak_tubuh.push(value.nilai);
                    break;
                
                case 'Massa Tulang':
                    nilai.massa_tulang.push(value.nilai);
                    break;
                
                case 'Kadar Air':
                    nilai.kadar_air.push(value.nilai);
                    break;
                
                case 'Massa Otot':
                    nilai.massa_otot.push(value.nilai);
                    break;
                
                case 'Rating Fisik':
                    nilai.rating_fisik.push(value.nilai);
                    break;
                
                case 'BMR':
                    nilai.bmr.push(value.nilai);
                    break;
                
                case 'Usia Sel':
                    nilai.usia_sel.push(value.nilai);
                    break;
                
                case 'Lemak Visceral':
                    nilai.lemak_visceral.push(value.nilai);
                    break;
            }
            // console.log($.inArray(value.tanggal, tanggal));
            if($.inArray(value.tanggal, tanggal) == -1){
                tanggal.push(value.tanggal);
            }

        });

        var ctx = $('#line-chart');    

        var data = {
            labels: tanggal,
            datasets: [
                {
                    label: "Berat",
                    data: nilai.berat,
                    backgroundColor: 'red',
                    borderColor: 'red',
                    fill: false,
                    lineTension: 0,
                    pointRadius: 5
                },
                {
                    label: "Lemak Tubuh",
                    data: nilai.lemak_tubuh,
                    backgroundColor: 'orange',
                    borderColor: 'orange',
                    fill: false,
                    lineTension: 0,
                    pointRadius: 5
                },
                {
                    label: "Massa Tulang",
                    data: nilai.massa_tulang,
                    backgroundColor: 'yelow',
                    borderColor: 'yellow',
                    fill: false,
                    lineTension: 0,
                    pointRadius: 5
                },
                {
                    label: "Kadar Air",
                    data: nilai.kadar_air,
                    backgroundColor: 'green',
                    borderColor: 'green',
                    fill: false,
                    lineTension: 0,
                    pointRadius: 5
                },
                {
                    label: "Massa Otot",
                    data: nilai.massa_otot,
                    backgroundColor: 'blue',
                    borderColor: 'blue',
                    fill: false,
                    lineTension: 0,
                    pointRadius: 5
                },
                {
                    label: "Rating Fisik",
                    data: nilai.rating_fisik,
                    backgroundColor: 'magenta',
                    borderColor: 'magenta',
                    fill: false,
                    lineTension: 0,
                    pointRadius: 5
                },
                {
                    label: "BMR",
                    data: nilai.bmr,
                    backgroundColor: 'purple',
                    borderColor: 'purple',
                    fill: false,
                    lineTension: 0,
                    pointRadius: 5
                },
                {
                    label: "Usia Sel",
                    data: nilai.usia_sel,
                    backgroundColor: 'red',
                    borderColor: 'red',
                    fill: false,
                    lineTension: 0,
                    pointRadius: 5
                },
                {
                    label: "Lemak Visceral",
                    data: nilai.lemak_visceral,
                    backgroundColor: 'red',
                    borderColor: 'red',
                    fill: false,
                    lineTension: 0,
                    pointRadius: 5
                }
            ]
        }    

        var options = {
            title:{
                display: true,
                position: 'top',
                text: $('#customer').val(),
                fontSize: 24,
                fontColor: '#333'
            },
            legend:{
                display: true,
                position: 'bottom'
            }
        };

        var chart = new Chart(ctx, {
            type: 'line',
            data: data,
            options: options
        });

    })
</script>
<?php $this->load->view('./komponen/footer'); ?>