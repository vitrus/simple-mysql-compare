<!DOCTYPE html>
<html>
<head>
    <title>Database comparison tool</title>
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

        <h1>Database comparison</h1>

        <table class="table table-striped">
            <tr>
                <th>Table name</th>
                <?php foreach($databases as $db){ ?>
                    <th><?php print $db['name']; ?></th>
                <?php } ?>
            </tr>
            <?php foreach($all_tables as $table){ ?>
            <tr class="<?php if(!in_array($table, $databases[0]['tables'])){ print "row-missing-left"; } else if(!in_array($table, $databases[1]['tables'])) { print "row-missing-right"; } ?>">
                <td>
                    <?php if(in_array($table, $databases[0]['tables']) && in_array($table, $databases[1]['tables'])){ ?>
                        <a href="?table=<?php print $table; ?>">
                            <?php print $table; ?>
                        </a>
                    <?php } else { ?>
                        <?php print $table; ?>
                    <?php } ?>
                </td>
                <td>
                    <?php if(in_array($table, $databases[0]['tables'])){ ?>
                        <span class="glyphicon glyphicon-ok" aria-hidden="true" style="color: green;"></span>
                    <?php } else { ?>
                        <span class="glyphicon glyphicon-remove" aria-hidden="true" style="color: red;"></span>
                    <?php } ?>
                </td>
                <td>
                    <?php if(in_array($table, $databases[1]['tables'])){ ?>
                        <span class="glyphicon glyphicon-ok" aria-hidden="true" style="color:green;"></span>
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