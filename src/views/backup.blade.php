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
    <script src="https://unpkg.com/vue/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/vue.resource/1.0.3/vue-resource.min.js"></script>

    <style type="text/css">
        body {
            font-family: Helvetica Neue, Arial, sans-serif;
            font-size: 14px;
            color: #444;
        }

        th {
            background-color: #42b983;
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
    </style>
</head>

<body>

<!-- componet root element -->
<div id="componet" class="col-md-12 col-lg-12  col-xl-12">
    <div class="row">
        <div class="col-md-9"></div>
        <div class="col-md-3 text-right">
            <form id="search" class="form-inline">
                <label class="sr-only" for="inlineFormInputGroup">Search</label>
                <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                    <input name="query" v-model="searchQuery" type="text" class="form-control" id="inlineFormInputGroup"
                           placeholder="Search">
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12 ">
            <componet-grid
                    :data="gridData"
                    :columns="gridColumns"
                    :filter-key="searchQuery">
            </componet-grid>
        </div>
    </div>
</div>

<!-- template -->
<script type="text/x-template" id="grid-template">
    <table class="table table-striped table-bordered table-hover ">
        <thead>
        <tr>
            <th v-for="key in columns"
            @click="sortBy(key)"
            :class="{ active: sortKey == key }">
            @{{ key | capitalize }}
            <span class="arrow" :class="sortOrders[key] > 0 ? 'asc' : 'dsc'"></span>
            </th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="entry in filteredData">
            <td v-for="key in columns" scope="row">
                @{{entry[key]}}
            </td>
        </tr>
        </tbody>
    </table>
</script>


<script type="text/javascript">
    Vue.component('componet-grid', {
        template: '#grid-template',
        props: {
            data: Array,
            columns: Array,
            filterKey: String
        },
        data: function () {
            var sortOrders = {}
            this.columns.forEach(function (key) {
                sortOrders[key] = 1
            })
            return {
                sortKey: '',
                sortOrders: sortOrders
            }
        },
        computed: {
            filteredData: function () {
                var sortKey = this.sortKey
                var filterKey = this.filterKey && this.filterKey.toLowerCase()
                var order = this.sortOrders[sortKey] || 1
                var data = this.data
                if (filterKey) {
                    data = data.filter(function (row) {
                        return Object.keys(row).some(function (key) {
                            return String(row[key]).toLowerCase().indexOf(filterKey) > -1
                        })
                    })
                }
                if (sortKey) {
                    data = data.slice().sort(function (a, b) {
                        a = a[sortKey]
                        b = b[sortKey]
                        return (a === b ? 0 : a > b ? 1 : -1) * order
                    })
                }
                return data
            }
        },
        filters: {
            capitalize: function (str) {
                return str.charAt(0).toUpperCase() + str.slice(1)
            }
        },
        methods: {
            sortBy: function (key) {
                this.sortKey = key
                this.sortOrders[key] = this.sortOrders[key] * -1
            }
        }
    })

    // bootstrap the componet
    var componet = new Vue({
        el: '#componet',
        data: {
            searchQuery: '',
            gridColumns: [],
            gridData: []
            /*gridData: [
             {name: 'Chuck Norris', power: Infinity},
             {name: 'Bruce Lee', power: 9000},
             {name: 'Jackie Chan', power: 7000},
             {name: 'Jet Li', power: 8000}
             ]*/
        },
        created: function () {
            this.fetchData();
        },

        methods: {
            fetchData: function (val) {
                // ajax get County list
                this.$http.get('/accessuserlog/show/')
                    .then(function (response) {
                        console.log(response.body);
                        this.gridData = response.body.results;
                        this.gridColumns = response.body.colons;
                    }, function (error) {
                        console.log(error);
                    });
            } // displayCounty
        }
    })

</script>
</body>
</html>