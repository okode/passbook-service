Passbook Service
================

Simple PHP Service for Passbook creation.

Building
--------

    $ docker build -t passbook .

Running
-------

    $ docker run --name=passbook -h passbook -p 8080:80 -d passbook

Open a browser at:

    http://$(docker-machine ip default):8080
