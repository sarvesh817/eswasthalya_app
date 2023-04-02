
<!-- start: page footer -->
    <footer class="page-footer px-xl-4 px-sm-2 px-0 py-3">
      <div class="container-fluid d-flex flex-wrap justify-content-between align-items-center">
        <p class="col-md-4 mb-0 text-muted">© 2022 <a href="#" target="_blank" title="e-Swasthalya Infotech LLP">e-Swasthalya</a>, All Rights Reserved.</p>
        <ul class="nav col-md-4 justify-content-center justify-content-lg-end">
          <li class="nav-item"><a href="#" target="_blank" class="nav-link px-2 text-muted">Website</a></li>
          <li class="nav-item"><a href="#" target="_blank" class="nav-link px-2 text-muted">licenses</a></li>
          <li class="nav-item"><a href="#" target="_blank" class="nav-link px-2 text-muted">Support</a></li>
          <li class="nav-item"><a href="#" target="_blank" class="nav-link px-2 text-muted">FAQs</a></li>
        </ul>
      </div>
    </footer>
  </div>
  
  <script src="<?php echo base_url(); ?>bassets/js/jquery.min.js"></script>
   
  <!--<script src="<?php echo base_url(); ?>bassets/js/jquery3-2-1.min.js"></script>-->
  <script src="<?php echo base_url(); ?>bassets/js/select2.min.js"></script>
  <script src="<?php echo base_url(); ?>bassets/js/theme.js"></script>
  <!-- Plugin Js -->
  <script src="<?php echo base_url(); ?>bassets/js/bundle/apexcharts.bundle.js"></script>
  <script src="<?php echo base_url(); ?>bassets/js/bundle/dataTables.bundle.js"></script>
  <!-- Vendor Script -->
  <script src="<?php echo base_url(); ?>bassets/js/bundle/apexcharts.bundle.js"></script>
  <script src="<?php echo base_url(); ?>bassets/js/main.js"></script>
  <script src="<?php echo base_url(); ?>bassets/js/slot-management.js"></script>
  
  <!-- Medical History Record Datatable -->
  <script>
      $('#medicalHistoryTable').addClass('nowrap').dataTable({
      responsive: true,
    });
        $('#prescriptionTable').addClass('nowrap').dataTable({
      responsive: true,
    });
    $('#labReportTable').addClass('nowrap').dataTable({
      responsive: true,
    });
    $('#mediaReportTable').addClass('nowrap').dataTable({
      responsive: true,
    });
  </script>
  <!-- End -->
    
  <!-- Jquery Core Js -->
  <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.form.js"></script>
  
  <!-- Plugin Js -->
    <script src="<?php echo base_url(); ?>bassets/js/bundle/daterangepicker.bundle.js"></script>
    <!-- Jquery Page Js -->
    <script>
      // date range picker
      $(function() {
        $('input[name="daterange"]').daterangepicker({
          opens: 'left'
        }, function(start, end, label) {
          console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });
      })
    </script>
  <script>
    $(window).on('load', function () {
      setTimeout(function () {
        $('#verifypatientbeforeappointment').modal('show');
      }, 1000)
    });

    $(document).ready(function () {
      $("#verifypid").click(function () {
        $("#hideshow-details").toggleClass("d-none").fadeIn(600);
      });
    });
    
    // Select Multiple Dropdown
		$(".js-select2").select2({
			closeOnSelect : false,
			placeholder : "Select Speciality",
			// allowHtml: true,
			allowClear: true,
			tags: true 
		});
		
// 		Video Calling
    $(window).on('load', function () {
            setTimeout(function(){
              $('#comingvideocalling').modal('show');
            },1000)
        });

// Window Events

function toggleWindow() {
  var screenSize = document.getElementById('screenSize')
  screenSize.classList.toggle('smallWindow')
}

function receiveVideoCalling() {
  var receiveVideoCalling = document.getElementById('screenSize')
  receiveVideoCalling.classList.add('receivedVideoCalling')
}
function declinedVideoCalling() {
  var receiveVideoCalling = document.getElementById('screenSize')
  receiveVideoCalling.classList.remove('receivedVideoCalling')
}
// End
  </script>
  <script>
    // top sparklines
    var randomizeArray = function(arg) {
      var array = arg.slice();
      var currentIndex = array.length,
        temporaryValue, randomIndex;
      while (0 !== currentIndex) {
        randomIndex = Math.floor(Math.random() * currentIndex);
        currentIndex -= 1;
        temporaryValue = array[currentIndex];
        array[currentIndex] = array[randomIndex];
        array[randomIndex] = temporaryValue;
      }
      return array;
    }
    // data for the sparklines that appear below header area
    var sparklineData = [47, 45, 54, 38, 56, 24, 65, 31, 54, 38, 56];
    // topb big chart    
    var spark1 = {
      chart: {
        type: 'line',
        height: 60,
        sparkline: {
          enabled: true
        },
      },
      stroke: {
        width: 2
      },
      series: [{
        data: randomizeArray(sparklineData)
      }],
      colors: ['var(--chart-color3)'],
    }
    var spark1 = new ApexCharts(document.querySelector("#apexspark1"), spark1);
    spark1.render();
    var spark2 = {
      chart: {
        type: 'line',
        height: 60,
        sparkline: {
          enabled: true
        },
      },
      stroke: {
        width: 2
      },
      series: [{
        data: randomizeArray(sparklineData)
      }],
      colors: ['var(--chart-color5)'],
    }
    var spark2 = new ApexCharts(document.querySelector("#apexspark2"), spark2);
    spark2.render();
    var spark3 = {
      chart: {
        type: 'line',
        height: 60,
        sparkline: {
          enabled: true
        },
      },
      stroke: {
        width: 2
      },
      series: [{
        data: randomizeArray(sparklineData)
      }],
      colors: ['var(--chart-color1)'],
    }
    var spark3 = new ApexCharts(document.querySelector("#apexspark3"), spark3);
    spark3.render();
    var spark4 = {
      chart: {
        type: 'line',
        height: 60,
        sparkline: {
          enabled: true
        },
      },
      stroke: {
        width: 2
      },
      series: [{
        data: randomizeArray(sparklineData)
      }],
      colors: ['var(--chart-color2)'],
    }
    var spark4 = new ApexCharts(document.querySelector("#apexspark4"), spark4);
    spark4.render();
    //Avg Treatment Costs
    var options = {
      series: [{
        name: 'Costs',
        data: [123, 80, 114, 109, 112, 146, 137, 123, 99, ]
      }],
      chart: {
        height: 285,
        type: 'bar',
        toolbar: {
          show: false,
        },
      },
      colors: ['var(--chart-color1)'],
      plotOptions: {
        bar: {
          dataLabels: {
            position: 'top', // top, center, bottom
          },
        }
      },
      dataLabels: {
        enabled: true,
        formatter: function(val) {
          return val + "$";
        },
        offsetY: -20,
        style: {
          fontSize: '12px',
          colors: ['var(--color-500)'],
        }
      },
      xaxis: {
        categories: ["0-9", "10-20", "21-30", "31-40", "41-50", "51-60", "61-70", "71-80", "81+"],
        position: 'bottom',
        axisBorder: {
          show: false
        },
        axisTicks: {
          show: false
        },
        tooltip: {
          enabled: true,
        }
      },
      yaxis: {
        axisBorder: {
          show: false
        },
        axisTicks: {
          show: false,
        },
        labels: {
          show: false,
          formatter: function(val) {
            return val + "$";
          }
        }
      }
    };
    var chart = new ApexCharts(document.querySelector("#apex-ATCosts"), options);
    chart.render();
    // Hospital Survey
    var options = {
      chart: {
        height: 330,
        type: 'bar',
        toolbar: {
          show: false,
        },
      },
      colors: ['var(--chart-color1)'],
      grid: {
        yaxis: {
          lines: {
            show: false,
          }
        },
        padding: {
          top: 0,
          right: 0,
          bottom: 0,
          left: 0
        },
      },
      plotOptions: {
        bar: {
          horizontal: true,
        }
      },
      dataLabels: {
        enabled: false
      },
      series: [{
        data: [400, 430, 448, 470, 540, 580, 690, 1100, 1200, 1380]
      }],
      xaxis: {
        categories: ['South Korea', 'Canada', 'United Kingdom', 'Netherlands', 'Italy', 'France', 'Japan', 'United States', 'China', 'Germany'],
      }
    }
    var chart = new ApexCharts(document.querySelector("#apex-HospitalSurvey"), options);
    chart.render();
    // Gender Overview
    var options = {
      series: [{
        name: 'Males',
        data: [0.4, 0.65, 0.76, 0.88, 1.5, 2.1, 2.9, 4.1, 4.2, 4.5, 3.9, 3.5, 3]
      }, {
        name: 'Females',
        data: [-0.8, -1.05, -1.06, -1.18, -1.4, -2.2, -4.4, -4.1, -4, -4.1, -3.4, -3.1, -2.8]
      }],
      chart: {
        type: 'bar',
        height: 330,
        stacked: true,
        toolbar: {
          show: false,
        },
      },
      colors: ['var(--chart-color2)', 'var(--chart-color3)'],
      plotOptions: {
        bar: {
          horizontal: true,
          barHeight: '80%',
        },
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        width: 1,
        colors: ["#fff"]
      },
      grid: {
        xaxis: {
          lines: {
            show: false
          }
        }
      },
      yaxis: {
        min: -5,
        max: 5,
        title: {
          // text: 'Age',
        },
      },
      tooltip: {
        shared: false,
        x: {
          formatter: function(val) {
            return val
          }
        },
        y: {
          formatter: function(val) {
            return Math.abs(val) + "%"
          }
        }
      },
      xaxis: {
        categories: ['70+', '56-70', '36-55', '21-35', '10-20', '0-9'],
        labels: {
          formatter: function(val) {
            return Math.abs(Math.round(val)) + "%"
          }
        }
      },
    };
    var chart = new ApexCharts(document.querySelector("#apex-GenderOverview"), options);
    chart.render();
    // project data table
    $('#myDataTable').addClass('nowrap').dataTable({
      responsive: true,
    });
  </script>
  
  <script src="<?php echo base_url();?>videocall/AgoraRTC_N-4.17.0.js"></script>
   <script src="<?php echo base_url();?>videocall/index.js"></script>
</body>
</html>
