<?require "config/config.php";
require "listadoTurnosFunc.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link href='css/fullcalendar.min.css' rel='stylesheet' />
<link href='css/fullcalendar.print.min.css' rel='stylesheet' media='print' />
<link href='css/scheduler.min.css' rel='stylesheet' />
<script src='js/moment.min.js'></script>
<script src='js/jquery.min.js'></script>
<script src='js/fullcalendar.min.js'></script>
<script src='js/scheduler.min.js'></script>
	<title>test</title>
</head>
<body>
<div id="consultorioLun"></div>
<div id="consultorioMar"></div>
<div id="consultorioMie"></div>
<div id="consultorioJue"></div>
<div id="consultorioVie"></div>
<div id="consultorioSab"></div>
  <!--<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Company name</a>
      <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="#">Sign out</a>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" href="#">
                  <span data-feather="home"></span>
                  Dashboard <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="file"></span>
                  Orders
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="shopping-cart"></span>
                  Products
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="users"></span>
                  Customers
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="bar-chart-2"></span>
                  Reports
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="layers"></span>
                  Integrations
                </a>
              </li>
            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Saved reports</span>
              <a class="d-flex align-items-center text-muted" href="#">
                <span data-feather="plus-circle"></span>
              </a>
            </h6>
            <ul class="nav flex-column mb-2">
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="file-text"></span>
                  Current month
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="file-text"></span>
                  Last quarter
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="file-text"></span>
                  Social engagement
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="file-text"></span>
                  Year-end sale
                </a>
              </li>
            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Dashboard</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
                <button class="btn btn-sm btn-outline-secondary">Share</button>
                <button class="btn btn-sm btn-outline-secondary">Export</button>
              </div>
              <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar"></span>
                This week
              </button>
            </div>
          </div>             
        </main>
      </div>
    </div>-->
  
</body>
</html>
<script>
 $('#consultorioLun').fullCalendar({
  schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
     defaultView: 'agendaDay', height: 'auto',
      defaultDate: '2018-04-07',
      slotDuration: '01:00:00',
      minTime: "09:00:00",
      maxTime: "22:00:00",
      header: {
        left: '',
        center: '',
        right: ''
      },
      allDaySlot: false,
      resources: [
        { id: '1', title: 'Consultorio 1'},
        { id: '2', title: 'Consultorio 2'},
        { id: '3', title: 'Consultorio 3'},
        { id: '4', title: 'Consultorio 4'}
      ],
      events:<?obtenerConsultorios(1);?>,
      dayClick: function(date, jsEvent, view, resource) {
        console.log(
          'dayClick',
          date.format(),
          resource ? resource.id : '(no resource)'
        );
      }
    });
    $('#consultorioMar').fullCalendar({
  schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
     defaultView: 'agendaDay', height: 'auto',
      defaultDate: '2018-04-07',
      slotDuration: '01:00:00',
      minTime: "09:00:00",
      maxTime: "22:00:00",
      header: {
        left: '',
        center: '',
        right: ''
      },
      allDaySlot: false,
      resources: [
        { id: '1', title: 'Consultorio 1'},
        { id: '2', title: 'Consultorio 2'},
        { id: '3', title: 'Consultorio 3'},
        { id: '4', title: 'Consultorio 4'}
      ],
      events:<?obtenerConsultorios(2);?>,
      dayClick: function(date, jsEvent, view, resource) {
        console.log(
          'dayClick',
          date.format(),
          resource ? resource.id : '(no resource)'
        );
      }
    });
    $('#consultorioMie').fullCalendar({
  schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
     defaultView: 'agendaDay', height: 'auto',
      defaultDate: '2018-04-07',
      slotDuration: '01:00:00',
      minTime: "09:00:00",
      maxTime: "22:00:00",
      header: {
        left: '',
        center: '',
        right: ''
      },
      allDaySlot: false,
      resources: [
        { id: '1', title: 'Consultorio 1'},
        { id: '2', title: 'Consultorio 2'},
        { id: '3', title: 'Consultorio 3'},
        { id: '4', title: 'Consultorio 4'}
      ],
      events:<?obtenerConsultorios(3);?>,
      dayClick: function(date, jsEvent, view, resource) {
        console.log(
          'dayClick',
          date.format(),
          resource ? resource.id : '(no resource)'
        );
      }
    });
    $('#consultorioJue').fullCalendar({
  schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
     defaultView: 'agendaDay', height: 'auto',
      defaultDate: '2018-04-07',
      slotDuration: '01:00:00',
      minTime: "09:00:00",
      maxTime: "22:00:00",
      header: {
        left: '',
        center: '',
        right: ''
      },
      allDaySlot: false,
      resources: [
        { id: '1', title: 'Consultorio 1'},
        { id: '2', title: 'Consultorio 2'},
        { id: '3', title: 'Consultorio 3'},
        { id: '4', title: 'Consultorio 4'}
      ],
      events:<?obtenerConsultorios(4);?>,
      dayClick: function(date, jsEvent, view, resource) {
        console.log(
          'dayClick',
          date.format(),
          resource ? resource.id : '(no resource)'
        );
      }
    });
    $('#consultorioVie').fullCalendar({
  schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
     defaultView: 'agendaDay', height: 'auto',
      defaultDate: '2018-04-07',
      slotDuration: '01:00:00',
      minTime: "09:00:00",
      maxTime: "22:00:00",
      header: {
        left: '',
        center: '',
        right: ''
      },
      allDaySlot: false,
      resources: [
        { id: '1', title: 'Consultorio 1'},
        { id: '2', title: 'Consultorio 2'},
        { id: '3', title: 'Consultorio 3'},
        { id: '4', title: 'Consultorio 4'}
      ],
      events:<?obtenerConsultorios(5);?>,
      dayClick: function(date, jsEvent, view, resource) {
        console.log(
          'dayClick',
          date.format(),
          resource ? resource.id : '(no resource)'
        );
      }
    });
    $('#consultorioSab').fullCalendar({
  schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
     defaultView: 'agendaDay', height: 'auto',
      defaultDate: '2018-04-07',
      slotDuration: '01:00:00',
      minTime: "09:00:00",
      maxTime: "22:00:00",
      header: {
        left: '',
        center: '',
        right: ''
      },
      allDaySlot: false,
      resources: [
        { id: '1', title: 'Consultorio 1'},
        { id: '2', title: 'Consultorio 2'},
        { id: '3', title: 'Consultorio 3'},
        { id: '4', title: 'Consultorio 4'}
      ],
      events:<?obtenerConsultorios(6);?>,
      dayClick: function(date, jsEvent, view, resource) {
        console.log(
          'dayClick',
          date.format(),
          resource ? resource.id : '(no resource)'
        );
      }
    });
</script>