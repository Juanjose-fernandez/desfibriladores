
    <canvas id="study-percentage" ></canvas>


    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <!--Charts-->
    <script src="{{URL::asset('/js/plugin/chart/Chart.js')}}"></script>
    <script src="{{URL::asset('/js/plugin/chart/Chart.bundle.js')}}"></script>


    <script type="text/javascript">
        $(document).ready(function() {

            var totalStudyTime = {!! $totalRepertoryStudyTime !!} + {!! $totalTechniqueStudyTime !!} ;
            var techniquePercentage = ( {!! $totalTechniqueStudyTime !!} / totalStudyTime) * 100;
            var repertoryPercentage = ( {!! $totalRepertoryStudyTime !!} / totalStudyTime) * 100;

            var techniqueTimeLabel;
            var repertoryTimeLabel;

            var techniqueTimeInSeconds = {!! $totalTechniqueStudyTime !!} ;
            console.log(techniqueTimeInSeconds);
            var techniqueTimeInHours = {!! $totalTechniqueStudyTime !!} /3600 ;
            var repertoryTimeInHours = {!! $totalRepertoryStudyTime !!} /3600 ;

            if( techniqueTimeInHours < 1 ){
                var techniqueTimeInMinutes = {!! $totalTechniqueStudyTime !!} /60 ;
                techniqueTimeInMinutes = Math.round(techniqueTimeInMinutes);
                techniqueTimeLabel = techniqueTimeInMinutes + ' min';
            } else {
                techniqueTimeLabel = Math.round(techniqueTimeInHours * 10) /10;
                techniqueTimeLabel += ' h';
            }

            if( repertoryTimeInHours < 1 ){
                var repertoryTimeInMinutes = {!! $totalRepertoryStudyTime !!} /60 ;
                repertoryTimeInMinutes = Math.round(repertoryTimeInMinutes);
                repertoryTimeLabel = repertoryTimeInMinutes + ' min';
            } else {
                repertoryTimeLabel = Math.round(repertoryTimeInHours * 10) /10;
                repertoryTimeLabel += ' h';
            }

            techniquePercentage = Math.round(techniquePercentage * 100) / 100;
            repertoryPercentage = Math.round(repertoryPercentage * 100) / 100;

            console.log(totalStudyTime);
            data = {
                datasets: [{
                    data: [ techniquePercentage  , repertoryPercentage],

                    backgroundColor: [
                        'rgba(255, 205, 86)',
                        'rgba(54, 162, 235)'
                    ]
                }],
                // These labels appear in the legend and in the tooltips when hovering different arcs
                labels: [
                    'Técnica '+ techniqueTimeLabel,
                    'Repertorio ' + repertoryTimeLabel
                ],
            };

            var ctx = $("#study-percentage");

            var myPieChart = new Chart(ctx,{
                type: 'pie',
                data: data,
                //options: options
            });

        });
    </script>

