<!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script
      src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
      crossorigin="anonymous"
    ></script>
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="./js/adminlte.js"></script>
    <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
    <script>
      const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
      const Default = {
        scrollbarTheme: 'os-theme-light',
        scrollbarAutoHide: 'leave',
        scrollbarClickScroll: true,
      };
      document.addEventListener('DOMContentLoaded', function () {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
        if (sidebarWrapper && OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined) {
          OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
            scrollbars: {
              theme: Default.scrollbarTheme,
              autoHide: Default.scrollbarAutoHide,
              clickScroll: Default.scrollbarClickScroll,
            },
          });
        }
      });
    </script>
    <!--end::OverlayScrollbars Configure-->
    <!-- OPTIONAL SCRIPTS -->
    <!-- sortablejs -->
    <script
      src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"
      crossorigin="anonymous"
    ></script>
    <!-- sortablejs -->
    <script>
      new Sortable(document.querySelector('.connectedSortable'), {
        group: 'shared',
        handle: '.card-header',
      });

      const cardHeaders = document.querySelectorAll('.connectedSortable .card-header');
      cardHeaders.forEach((cardHeader) => {
        cardHeader.style.cursor = 'move';
      });
    </script>
    <!-- apexcharts -->
    <script
      src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"
      integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8="
      crossorigin="anonymous"
    ></script>
    <!-- ChartJS -->
    <script>
      // NOTICE!! DO NOT USE ANY OF THIS JAVASCRIPT
      // IT'S ALL JUST JUNK FOR DEMO
      // ++++++++++++++++++++++++++++++++++++++++++

      const sales_chart_options = {
        series: [
          {
            name: 'Digital Goods',
            data: [28, 48, 40, 19, 86, 27, 90],
          },
          {
            name: 'Electronics',
            data: [65, 59, 80, 81, 56, 55, 40],
          },
        ],
        chart: {
          height: 300,
          type: 'area',
          toolbar: {
            show: false,
          },
        },
        legend: {
          show: false,
        },
        colors: ['#0d6efd', '#20c997'],
        dataLabels: {
          enabled: false,
        },
        stroke: {
          curve: 'smooth',
        },
        xaxis: {
          type: 'datetime',
          categories: [
            '2023-01-01',
            '2023-02-01',
            '2023-03-01',
            '2023-04-01',
            '2023-05-01',
            '2023-06-01',
            '2023-07-01',
          ],
        },
        tooltip: {
          x: {
            format: 'MMMM yyyy',
          },
        },
      };

      const sales_chart = new ApexCharts(
        document.querySelector('#revenue-chart'),
        sales_chart_options,
      );
      sales_chart.render();
    </script>
    <!-- jsvectormap -->
    <script
      src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/js/jsvectormap.min.js"
      integrity="sha256-/t1nN2956BT869E6H4V1dnt0X5pAQHPytli+1nTZm2Y="
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/maps/world.js"
      integrity="sha256-XPpPaZlU8S/HWf7FZLAncLg2SAkP8ScUTII89x9D3lY="
      crossorigin="anonymous"
    ></script>
    <!-- jsvectormap -->
    <script>
      // World map by jsVectorMap
      new jsVectorMap({
        selector: '#world-map',
        map: 'world',
      });

      // Sparkline charts
      const option_sparkline1 = {
        series: [
          {
            data: [1000, 1200, 920, 927, 931, 1027, 819, 930, 1021],
          },
        ],
        chart: {
          type: 'area',
          height: 50,
          sparkline: {
            enabled: true,
          },
        },
        stroke: {
          curve: 'straight',
        },
        fill: {
          opacity: 0.3,
        },
        yaxis: {
          min: 0,
        },
        colors: ['#DCE6EC'],
      };

      const sparkline1 = new ApexCharts(document.querySelector('#sparkline-1'), option_sparkline1);
      sparkline1.render();

      const option_sparkline2 = {
        series: [
          {
            data: [515, 519, 520, 522, 652, 810, 370, 627, 319, 630, 921],
          },
        ],
        chart: {
          type: 'area',
          height: 50,
          sparkline: {
            enabled: true,
          },
        },
        stroke: {
          curve: 'straight',
        },
        fill: {
          opacity: 0.3,
        },
        yaxis: {
          min: 0,
        },
        colors: ['#DCE6EC'],
      };

      const sparkline2 = new ApexCharts(document.querySelector('#sparkline-2'), option_sparkline2);
      sparkline2.render();

      const option_sparkline3 = {
        series: [
          {
            data: [15, 19, 20, 22, 33, 27, 31, 27, 19, 30, 21],
          },
        ],
        chart: {
          type: 'area',
          height: 50,
          sparkline: {
            enabled: true,
          },
        },
        stroke: {
          curve: 'straight',
        },
        fill: {
          opacity: 0.3,
        },
        yaxis: {
          min: 0,
        },
        colors: ['#DCE6EC'],
      };

      const sparkline3 = new ApexCharts(document.querySelector('#sparkline-3'), option_sparkline3);
      sparkline3.render();
    </script>

    {{-- jquery --}}
    <script src="{{ url('admin/js/jquery-3.7.1.min.js') }}"></script>

    {{-- jquery UI --}}
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

    {{-- custom script --}}
    <script src="{{ url('admin/js/custom.js') }}"></script>

    {{-- Datatable --}}

      <!--DataTables Css -->
      <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

      <!--ColReorder Css -->
      <link rel="stylesheet" href="https://cdn.datatables.net/colreorder/1.6.2/css/colReorder.dataTables.min.css">

      <!---Buttons CSS -->
      <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

      {{-- <!--jQuery -->
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

      <!--DataTables JS -->
      <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

      <!--ColReorder JS -->
      <script src="https://cdn.datatables.net/colreorder/1.6.2/js/dataTables.colReorder.min.js"></script>

      <!---Buttons Extension -->
      <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>

      <!---Column Visibility -->
      <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>

    <script>
      $(document).ready(function(){
         $("#subadmins").DataTable();
         $("#brands").DataTable();
        
        const tablesConfig = [
          {
            id: "categories",
            savedOrder: {!! json_encode($categoriesSavedOrder ?? null) !!},
            hiddenCols: {!! json_encode($categoriesHiddenCols ?? []) !!},
            tableName: "categories"
          },
          {
            id: "products",
            savedOrder: {!! json_encode($productsSavedOrder ?? null) !!},
            hiddenCols: {!! json_encode($productsHiddenCols ?? []) !!},
            tableName: "products"
          }
        ];
        tablesConfig.forEach(config => {
          const tableElement = $("#" + config.id);
          if (tableElement.length > 0) {
            let dataTable = tableElement.DataTable({
              order: [[0, "desc"]],
              colReorder: {
                order: config.savedOrder
              },
              dom: 'Bfrtip',
              buttons: ['colvis'],
              columnDefs: config.hiddenCols.map(index => ({
                targets: parseInt(index),
                visible: false
              }))
            });
            dataTable.on('column-reorder', function () {
              savePreference(config.tableName, dataTable.colReorder.order(),
              getHiddenColumnIndexes(dataTable));
            });
            dataTable.on('column-visibility.dt', function () {
              savePreference(config.tableName, dataTable.colReorder.order(),
              getHiddenColumnIndexes(dataTable));
            });
          }
        });
        function getHiddenColumnIndexes(dataTable) {
          let hidden = [];
          dataTable.columns().every(function (index) {
            if (!this.visible()) hidden.push(index);
          });
          return hidden;
        }
        function savePreference(tableName, columnOrder, hiddenCols) {
          $.ajax({
            url: "{{ url('admin/save-column-visibility') }}",
            type: "POST",
            data: {
                  _token: "{{ csrf_token() }}",
                  table_key: tableName,
                  column_order: columnOrder,
                  hidden_columns: hiddenCols
            },
            success: function (response) {
                console.log("Preference saved for " + tableName + ":", response);
            }
          });
        }
      });
    </script>

    {{-- sweet alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Dropzone css --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css">

    {{-- Dropzone js --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>

    <script>
      Dropzone.autoDiscover = false;

      // Main Image Dropzone
      let mainImageDropzone = new Dropzone("#mainImageDropzone", {
        url: "{{route('product.upload.image')}}",
        maxFiles: 1,
        acceptedFiles: "image/*",
        maxFilesize: 0.5,
        addRemoveLinks: true,
        dictDefaultMessage : "Drag & drop product image or click to upload",
        headers: {
          'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        success: function (file, response) {
          // store file name to refrence it during deletion
          file.uploadedFileName = response.fileName;
          document.getElementById('main_image_hidden').value = response.fileName;
        },
        removeFile:function (file) {
          //optinal:check if the file was successfully uploaded
          if (file.uploadedFileName) {
            $.ajax({
              url: "{{route('admin.products.delete-image')}}",
              type:'POST',
              data: {
                _token: "{{ csrf_token()}}",
                image: file.uploadedFileName
              },
              success: function (response) {
                console.log("Main image deleted successfully");
                // clear hidden field if the image is removed
                document.getElementById('main_image_hidden').value='';
              },
              error:function() {
                console.log("Error deleting main image");
              }
            });
          }
          // Remove preview from Dropzone UI
          var previewElement = file.previewElement;
          if (previewElement !==null) {
            previewElement.parentNode.removeChild(previewElement);
          }
        },
        error: function (file, message) {
          // Prevent multiple alerts for the same file
          if (!file.alreadyRejected) {
            file.alreadyRejected = true;
            // Show error message in the container instead of using alert()
            let errorContainer = document.getElementById('mainImageDropzoneError');
            if (errorContainer) {
              errorContainer.innertext = typeof message === 'string' ? message :
              message.message;
              errorContainer.style.display = 'block';
              // Hide after 4 second
              setTimeout(() => {
                errorContainer.style.display = 'none';
              }, 4000);
            }
          }
          this.removeFile(file);
        },
        init: function () {
          this.on("maxfilesexceeded", function(file) {
            this.removeAllFiles();
            this.addFile(file);
          });
        }
      });

      //Product Images DropZone
      let productImagesDropzone = new Dropzone("#productImagesDropzone", {
        url: "{{ route('product.upload.images') }}",
        maxFiles: 10,
        acceptedFiles: "image/*",
        parallelUploads: 10, // add this line to allow parallel uploads
        uploadMultiple: false, // keept this false unless you want to send all files in one request
        maxFilesize: 0.5,
        addRemoveLinks: true,
        dictDefaultMessage: "Drag & drop product images or click to upload",
        headers: {
          'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        init: function() {
          this.on("success", function(file, response) {
            // Append filename to hidden input
            let hiddenInput = document.getElementById('product_images_hidden');
            let currentVal = hiddenInput.value;
            hiddenInput.value = currentVal ? currentVal + ',' + response.fileName : response.fileName;
            file.uploadedFileName = response.fileName;
          });

          this.on("removedfile", function(file) {
            if (file.uploadedFileName) {
              let hiddenInput = document.getElementById('product_images_hidden');
              hiddenInput.value = hiddenInput.value.split(',').filter(name => name !== file.uploadedFileName).join(',');
              //optional: delete the file from sever
              $.ajax({
                url: "{{route('product.delete.temp.image')}}",
                type: 'POST',
                data: {filename: file.uploadedFileName},
                headers: {
                  'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
              });
            }
          });
        }
      });

      //Product Video Dropzone
      let productVideoDropzone = new Dropzone("#productVideoDropzone", {
        url: "{{route('product.upload.video')}}",
        maxFiles: 1,
        acceptedFiles: "video/*",
        maxFilesize: 2,
        addRemoveLinks: true,
        dictDefaultMessage : "Drag & drop product video or click to upload",
        headers: {
          'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        success: function (file, response) {
          document.getElementById('product_video_hidden').value = response.fileName;
          file.uploadedFileName = response.fileName;
        },
        removedFile:function (file) {
          if (file.uploadedFileName) {
            document.getElementById('product_video_hidden').value = '';
            $.ajax({
              url: "{{route('product.delete.temp.video')}}",
              type:'POST',
              data: {fileName:file.uploadedFileName},
              headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
            });
          }
          let previewElement = file.previewElement;
          if (previewElement !== null) {
            previewElement.parentNode.removeChild(previewElement);
          }
        },
        init: function () {
          this.on("maxfilesexceeded", function(file) {
            this.removeAllFiles();
            this.addFile(file);
          });
        }
      });

      //Product Image Sort Script
      $("#sortable-images").sortable({
        helper: 'clone',
        placeholder: "sortable-placeholder",
        forcePlaceholderSize: true,
        scroll: true,
        axis: 'x', // restrict to horizontal only
        update: function(event, ui) {
          let sortedIds = [];
          $('#sortable-images .sortable-item').each(function (index) {
            sortedIds.push({
              id: $(this).data('id'),
              sort: index
            });
          });
          $.ajax ({
            url: "{{ route('admin.products.update-image-sorting') }}",
            method: "POST",
            data: {
              _token: "{{csrf_token() }}",
              sorted_images: sortedIds
            }
          });
        }
      });
    </script>