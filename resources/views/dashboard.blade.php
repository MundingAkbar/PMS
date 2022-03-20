@extends('layouts.app')
@section('headscript')
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
          ['Mushrooms', 3],
          ['Onions', 1],
          ['Olives', 1],
          ['Zucchini', 1],
          ['Pepperoni', 2]
        ]);

        // Set chart options
        var options = {'title':'How Much Pizza I Ate Last Night',
                       'width':400,
                       'height':300};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
    <!-- =============================================== -->
    <!-- BAR CHART -->
        <script type="text/javascript">
                google.charts.load("current", {packages:["corechart"]});
                google.charts.setOnLoadCallback(drawChart);
                function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ["Element", "Density", { role: "style" } ],
                    ["Copper", 8.94, "#b87333"],
                    ["Silver", 10.49, "silver"],
                    ["Gold", 19.30, "gold"],
                    ["Platinum", 21.45, "color: #e5e4e2"]
                ]);

                var view = new google.visualization.DataView(data);
                view.setColumns([0, 1,
                                { calc: "stringify",
                                    sourceColumn: 1,
                                    type: "string",
                                    role: "annotation" },
                                2]);

                var options = {
                    title: "Density of Precious Metals, in g/cm^3",
                    width: 600,
                    height: 400,
                    bar: {groupWidth: "95%"},
                    legend: { position: "none" },
                };
                var chart = new google.visualization.BarChart(document.getElementById("barchart_values"));
                chart.draw(view, options);
        }
        </script>
@endsection
@section('content')
    <div class="text-center">
        <h3>Dashboard</h3>
    </div>
    <div class="dashboard-wrapper">
        <h6>PENDING TRANSACTIONS</h6>
        <!-- PENDINGS -->
        <div class="pending_transactions">
            <!-- DASHBOARD CARDS -->
            <div class="pending">
                 <h3>10</h3>
                <div class="details">
                    <div class="icon"></div>
                    <p>PENDING PAR</p>
                </div>
            </div>
            <!-- CARD END -->
            <!-- DASHBOARD CARDS -->
            <div class="pending">
                 <h3>10</h3>
                <div class="details">
                    <div class="icon"></div>
                    <p>PENDING ICS</p>
                </div>
            </div>
            <!-- CARD END -->
            <!-- DASHBOARD CARDS -->
            <div class="pending">
                <h3>10</h3>
                <div class="details">
                    <div class="icon"></div>
                    <p>PENDING REQUEST</p>
                </div>
            </div>
            <!-- CARD END -->
             <!-- DASHBOARD CARDS -->
             <div class="pending">
                <h3>10</h3>
                <div class="details">
                    <div class="icon"></div>
                    <p>VEHICLE DUE FOR RENEWAL</p>
                </div>
            </div>
            <!-- CARD END -->
        </div>
        <hr>
        <h6>CHARTS OVERVIEW</h6>
        <!-- PENDINGS END -->
         <div class="charts">
             <!--Div that will hold the pie chart-->
            <div id="chart_div"></div>
            <!--Div that will hold the pie chart-->
            <div id="barchart_values"></div>
         </div>
    </div>
@include('layouts.footer')
@endsection
    
   
@section('scripts')

@if( Session::has('logged') )
<script>
    swal({
        text: "{{ Session::get('logged') }}",
    });
</script>
{{ Session::forget('logged') }}
@endif

@endsection
