<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Acess user</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css"
          integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/vue/1.0.28/vue.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/vue.resource/1.0.3/vue-resource.min.js"></script>
    <script type="text/javascript" src="http://cdn.jsdelivr.net/vue.table/1.5.3/vue-table.min.js"></script>
    <style type="text/css">

        body {
            font-family: Helvetica Neue, Arial, sans-serif;
            font-size: 14px;
            color: #444;
        }

        th {
            background-color: #2185d0;
            color: rgba(255, 255, 255, 0.66);
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            font-weight: bold;
        }

        th, td {
            min-width: 120px;
            padding: 10px 20px;
        }

        th.active {
            color: #fff;
        }

        th.active .arrow {
            opacity: 1;
        }

        .arrow {
            display: inline-block;
            vertical-align: middle;
            width: 0;
            height: 0;
            margin-left: 5px;
            opacity: 0.66;
        }

        .arrow.asc {
            border-left: 4px solid transparent;
            border-right: 4px solid transparent;
            border-bottom: 4px solid #fff;
        }

        .arrow.dsc {
            border-left: 4px solid transparent;
            border-right: 4px solid transparent;
            border-top: 4px solid #fff;
        }

        ul.dropdown-menu li {
            margin-left: 20px;
        }

        .vuetable th.sortable:hover {
            color: #f0f0f0;
            cursor: pointer;
            font-weight: bold;
        }

        .vuetable-actions {
            width: 11%;
            padding: 12px 0px;
            text-align: center;
        }

        .vuetable-actions > button {
            padding: 3px 6px;
            margin-right: 4px;
        }

        .vuetable-pagination {
        }

        .vuetable-pagination-info {
            float: left;
            margin-top: auto;
            margin-bottom: auto;
        }

        .vuetable-pagination-component {
            float: right;
        }

        .vuetable-pagination-component .pagination {
            margin: 0px;
        }

        .vuetable-pagination-component .pagination .btn {
            cursor: pointer;
            margin: 2px;
        }

        [v-cloak] {
            display: none;
        }

        .highlight {
            background-color: yellow;
        }

        /* Loading Animation: */
        .vuetable-wrapper {
            opacity: 1;
            position: relative;
            filter: alpha(opacity=100); /* IE8 and earlier */
        }

        .vuetable-wrapper.loading {
            opacity: 0.4;
            transition: opacity .3s ease-in-out;
            -moz-transition: opacity .3s ease-in-out;
            -webkit-transition: opacity .3s ease-in-out;
        }

        .vuetable-wrapper.loading:after {
            position: absolute;
            content: '';
            top: 40%;
            left: 50%;
            margin: -30px 0 0 -30px;
            border-radius: 100%;
            -webkit-animation-fill-mode: both;
            animation-fill-mode: both;
            border: 4px solid #000;
            height: 60px;
            width: 60px;
            background: transparent !important;
            display: inline-block;
            -webkit-animation: pulse 1s 0s ease-in-out infinite;
            animation: pulse 1s 0s ease-in-out infinite;
        }

        @keyframes pulse {
            0% {
                -webkit-transform: scale(0.6);
                transform: scale(0.6);
            }
            50% {
                -webkit-transform: scale(1);
                transform: scale(1);
                border-width: 12px;
            }
            100% {
                -webkit-transform: scale(0.6);
                transform: scale(0.6);
            }
        }
        /* Loading Animation: */
        .vuetable-wrapper {
            position: relative;
            opacity: 1;
        }
        .loader {
            visibility: hidden;
            opacity: 0;
            transition: opacity 0.3s linear;
            width: 200px;
            height: 30px;
            font-size: 1.3em;
            text-align: center;
            margin-left: -100px;
            letter-spacing: 4px;
            color: #3881d6;
            position: absolute;
            top: 160px;
            left: 50%;
        }
        .loading .loader {
            visibility: visible;
            opacity: 1;
            z-index: 100;
        }
        .loading .vuetable{
            opacity:0.3;
            filter: alpha(opacity=30); /* IE8 and earlier */
        }
         .active{
            font-weight: bold;
             font-size: 110%;
             color: #3071be;
        }
        .active{
            font-weight: bold;
            font-size: 120%;
        }

    </style>
</head>

<body>

<div id="app" class="container">
    <div >

        <!-- Nav tabs -->
        <ul id="myTabs" class="nav  nav-pills nav-fill" role="tablist">
            <li role="presentation" class="nav-item">
                <a href="#Access"  v-on:click="chageTable"  class="nav-link active"   aria-controls="Access" role="tab" data-toggle="tab">Access</a>
            </li>
            <li role="presentation" class="nav-item">
                <a class="nav-link" href="#AccessAgents"  v-on:click="chageTable"  aria-controls="AccessAgents" role="tab" data-toggle="tab">Agents</a>
            </li>
            <li role="presentation" class="nav-item">
                <a class="nav-link" href="#AccessDevices"   v-on:click="chageTable"  aria-controls="AccessDevices" role="tab" data-toggle="tab">Devices</a>
            </li>
            <li role="presentation" class="nav-item">
                <a class="nav-link" href="#AccessDomains" v-on:click="chageTable"  aria-controls="AccessDomains" role="tab" data-toggle="tab">Url</a>
            </li>
            <li role="presentation" class="nav-item">
                <a class="nav-link" href="#AccessRoutes" v-on:click="chageTable"  aria-controls="AccessRoutes" role="tab" data-toggle="tab">Route</a>
            </li>
            <li role="presentation" class="nav-item">
                <a class="nav-link" href="#AccessUserLog" v-on:click="chageTable"  aria-controls="AccessUserLog" role="tab" data-toggle="tab">User</a>
            </li>
        </ul>


    </div>
    <!-- Example row of columns -->
    <h2 class="sub-header" id="title"> {!! $h1 !!}</h2>
    <hr>
    <div class="row">
        <div class="col-md-5">
            <div class="form-inline form-group">
                <label>Search:</label>
                <input v-model="searchFor" class="form-control" @keyup.enter="setFilter">
                <button class="btn btn-primary" @click="setFilter">Go</button>
                <button class="btn btn-default" @click="resetFilter">Reset</button>
            </div>
        </div>
        <div class="col-md-7">
            <div class="dropdown form-inline pull-right">
                <label>Pagination:</label>
                <select class="form-control" v-model="perPage">
                    <option value=10>10</option>
                    <option value=15>15</option>
                    <option value=20>20</option>
                    <option value=25>25</option>
                </select>

            </div>
        </div>
        <div class="col-md-12 col-lg-12 col-sm-12  ui vertical stripe segment">
            <div class="ui container">
                <div id="content" class="ui basic segment">
                    @include('accessuser::loading')
                    <!--Your Loading Message -->
                    <vuetable
                            :api-url="urlApi"
                            table-wrapper="#content"
                            :fields="columns"
                            :item-actions="itemActions"
                            pagination-path=""
                            table-class="table table-bordered table-striped table-hover"
                            ascending-icon="glyphicon glyphicon-chevron-up"
                            descending-icon="glyphicon glyphicon-chevron-down"
                            pagination-class=""
                            pagination-component-class=""
                            :pagination-component="paginationComponent"
                            :item-actions="itemActions"
                            :per-page="perPage"
                            :append-params="moreParams"
                            wrapper-class="vuetable-wrapper"
                            table-wrapper=".vuetable-wrapper"
                            loading-class="loading"
                            pagination-info-template="&nbsp;&nbsp; {from} - {to} out of {total} records"
                            pagination-info-no-data-template="The requested query return no result"
                    ></vuetable>
                </div>
            </div>
        </div>
    </div>

</div>
    <hr>



    <script type="text/javascript">

        // fields definition
        var tableColumns = {!! $fields !!}

        new Vue({
            el: '#app',
            data: {
                urlApi:'/accessuserlog/show/',
                urlApiColumns:'/accessuserlog/cols/',
                searchFor: '',
                columns: tableColumns,
                sortOrder: {
                    field: 'name',
                    direction: 'asc'
                },
                perPage: 10,
                paginationComponent: 'vuetable-pagination',
                paginationInfoTemplate: 'แสดง {from} ถึง {to} จากทั้งหมด {total} รายการ',
                itemActions: [
                    { name: 'view-item', label: 'var', icon: 'glyphicon glyphicon-search', class: 'btn btn-primary' }
                ],
                moreParams: [
                ]
            },
            watch: {
                'perPage': function (val, oldVal) {
                    this.$broadcast('vuetable:refresh')
                },
                'paginationComponent': function (val, oldVal) {
                    this.$broadcast('vuetable:load-success', this.$refs.vuetable.tablePagination)
                    this.paginationConfig(this.paginationComponent)
                }
            },
            methods: {
                /**
                 * Other functions
                 */
                setFilter: function () {
                    this.moreParams = [
                        'filter=' + this.searchFor
                    ]
                    this.$nextTick(function () {
                        this.$broadcast('vuetable:refresh')
                    })
                },
                resetFilter: function () {
                    this.searchFor = ''
                    this.setFilter()
                },
                chageTable: function (ev) {
                    var tag  = $(ev.target);
                    if(!tag.hasClass('active')){
                        $("#myTabs .active").removeClass("active");
                        var href =  tag.attr('href').replace('#',"");
                        tag.toggleClass('active');
                        this.moreParams = [
                            'table=' + href
                        ];
                        this.$http.get(this.urlApiColumns, {params:  {table: href}} ).then(
                            function (response) {
                                this.columns =  response.data;
                                this.$nextTick(function () {
                                    this.$broadcast('vuetable:refresh')
                                });
                                $(".sub-header").html(href);
                            }, function (error) {
                               console.dir(error)
                        });

                     }
                },

                changePaginationComponent: function () {
                    this.$broadcast('vuetable:load-success', this.$refs.vuetable.tablePagination)
                },
                preg_quote: function (str) {
                    // http://kevin.vanzonneveld.net
                    // +   original by: booeyOH
                    // +   improved by: Ates Goral (http://magnetiq.com)
                    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
                    // +   bugfixed by: Onno Marsman
                    // *     example 1: preg_quote("$40");
                    // *     returns 1: '\$40'
                    // *     example 2: preg_quote("*RRRING* Hello?");
                    // *     returns 2: '\*RRRING\* Hello\?'
                    // *     example 3: preg_quote("\\.+*?[^]$(){}=!<>|:");
                    // *     returns 3: '\\\.\+\*\?\[\^\]\$\(\)\{\}\=\!\<\>\|\:'

                    return (str + '').replace(/([\\\.\+\*\?\[\^\]\$\(\)\{\}\=\!\<\>\|\:])/g, "\\$1");
                },
                highlight: function (needle, haystack) {
                    return haystack.replace(
                        new RegExp('(' + this.preg_quote(needle) + ')', 'ig'),
                        '<span class="highlight">$1</span>'
                    )
                },
                paginationConfig: function (componentName) {
                    console.log('paginationConfig: ', componentName)
                    if (componentName == 'vuetable-pagination') {
                        this.$broadcast('vuetable-pagination:set-options', {
                            wrapperClass: 'pagination',
                            icons: {
                                first: '',
                                prev: '',
                                next: '',
                                last: ''},
                            activeClass: 'active',
                            linkClass: 'btn btn-default',
                            pageClass: 'btn btn-default'
                        })
                    }
                    if (componentName == 'vuetable-pagination-dropdown') {
                        this.$broadcast('vuetable-pagination:set-options', {
                            wrapperClass: 'form-inline',
                            icons: {
                                prev: 'glyphicon glyphicon-chevron-left',
                                next: 'glyphicon glyphicon-chevron-right'
                            },
                            dropdownClass: 'form-control'
                        })
                    }
                }
            },
            events: {
                'vuetable:action': function (action, data) {
                    console.log('vuetable:action', action, data)

                    if (action == 'view-item') {
                        console.log(action, data.name)
                    } else if (action == 'edit-item') {
                        sweetAlert(action, data.name)
                    } else if (action == 'delete-item') {
                        sweetAlert(action, data.name)
                    }
                },
                'vuetable:cell-dblclicked': function (item, field, event) {
                    var self = this
                    console.log('cell-dblclicked: old value =', item[field.name])
                },
                'vuetable:load-success': function (response) {
                    console.log('total = ', response.data.total)
                    var data = response.data.data
                    if (this.searchFor !== '') {
                        for (n in data) {
                            data[n].name = this.highlight(this.searchFor, data[n].name)
                            data[n].email = this.highlight(this.searchFor, data[n].email)
                        }
                    }
                },
                'vuetable:load-error': function (response) {
                    if (response.status == 400) {
                        sweetAlert('Something\'s Wrong!', response.data.message, 'error')
                    } else {
                        sweetAlert('Oops', E_SERVER_ERROR, 'error')
                    }
                }
            }


        });

        $( document ).ready(function() {
            /*$('#myTabs a').click(function (e) {
                e.preventDefault()

            })*/
        });
    </script>



</body>
</html>