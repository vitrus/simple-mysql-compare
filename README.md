## Database Compare Tool

A simple php tool to compare the structure of two mysql databases. 

It shows an overview of all the tables in the databases, whether they are present in both the left and right database and have the same type.

### Installation

1. Download or checkout the sources 
2. Supply your database information in config.php
3. Point your browser towards the index.php

### Why I wrote this tool

I had two (large) databases for two different systems that were very alike but kind of grew apart. The structure of those two databases needed to be reconciled into one single database. Opening the databases in two separate phpMyAdmin (or other database GUI) and compare became quite of a headache and the database comparison tools I found on github where not very intuitive to use. So I wrote this tool in an hour and decided to pubish it so it might save someone else an hour. 

I chose one of the databases as leading and needed to make sure every missing column (that was present in the other) was added and that the right choices were made regarding column types. That choice reflects in the colors this tool uses for comparison:

The differences are color coded: green = correct, yellow = field type differences, red = missing on the left, blue = missing on the right. For a quick overview of where the databases were not the same.

### Contribution

If you have any suggestions or issues, please create a ticket here on github.