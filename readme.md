# Simple war demo

## What is This?

This is a simple demo of two armies fighting. 
The rules are rather simple - more health wins.

##  How to run it?

Just serve it somehow (apache, nginx, PHP) and go to
the root document and provide the number of soldiers for each army
using two parameters, i.e. `/army1=50&army2=49`.

Some constraints apply, which can be configured in `app/config/war.php` file.