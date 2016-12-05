<!DOCTYPE html>
<html>
<head>
    <title>Compare table <?php print $_GET['table']; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap core CSS -->
    <link href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <!-- Custom style.css -->
    <link href="style.css" rel="stylesheet" media="screen">


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js"></script>
    <![endif]-->
</head>
<body>
<div class="container">


    <div class="starter-template">
        <div style="height: 30px;"></div>
        <div class="row">
            <div class="col-md-9">
                <h1>Table comparison: <?php print $_GET['table']; ?></h1>
            </div>
            <div class="col-md-3" style="padding-top: 20px;">

                <a class="btn btn-default" href="index.php">
                    Back to database overview
                </a>
            </div>
        </div>


        <table class="table table-striped">
            <tr>
                <th></th>
                <?php foreach($databases as $db){ ?>
                    <th colspan="2"><?php print $db['name']; ?></th>
                <?php } ?>
            </tr>
            <tr>
                <th>Table-name</th>
                <th>Type</th>
                <th>Nullable</th>
                <th>Type</th>
                <th>Nullable</th>
            </tr>
            <?php foreach($all_columns as $column){
                if(!isset($databases[0]['columns'][$column])){
                    $rowClass = "row-missing-left";
                } elseif(!isset($databases[1]['columns'][$column])){
                    $rowClass = "row-missing-right";
                } else if($databases[0]['columns'][$column]['Type'] != $databases[1]['columns'][$column]['Type']){
                    $rowClass = "row-different";
                } else if($databases[0]['columns'][$column]['Type'] != $databases[1]['columns'][$column]['Type']) {
                    $rowClass = "row-almost";
                } else {
                    $rowClass = "row-same";
                }
                ?>
                <tr class="<?php print $rowClass; ?>">
                    <td>
                        <?php print $column; ?>
                    </td>
                    <td>
                        <?php if(isset($databases[0]['columns'][$column])){ ?>
                            <?php print $databases[0]['columns'][$column]['Type']; ?>
                        <?php } else { ?>
                            <span class="glyphicon glyphicon-remove" aria-hidden="true" style="color: red;"></span>
                        <?php } ?>
                    </td>
                    <td>
                        <?php if(isset($databases[0]['columns'][$column])){ ?>
                            <?php print $databases[0]['columns'][$column]['Null']; ?>
                        <?php } else { ?>
                            <span class="glyphicon glyphicon-remove" aria-hidden="true" style="color: red;"></span>
                        <?php } ?>
                    </td>
                    <td>
                        <?php if(isset($databases[1]['columns'][$column])){ ?>
                            <?php print $databases[1]['columns'][$column]['Type']; ?>
                        <?php } else { ?>
                            <span class="glyphicon glyphicon-remove" aria-hidden="true" style="color: red;"></span>
                        <?php } ?>
                    </td>
                    <td>
                        <?php if(isset($databases[1]['columns'][$column])){ ?>
                            <?php print $databases[1]['columns'][$column]['Null']; ?>
                        <?php } else { ?>
                            <span class="glyphicon glyphicon-remove" aria-hidden="true" style="color: red;"></span>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
        </table>


    </div>

</div><!-- /.container -->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.2/js/bootstrap.min.js"></script>
</body>
</html>