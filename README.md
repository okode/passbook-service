Passbook Service
================

Simple PHP Service for Passbook creation.

Building
--------

Put your .p12 certificate in the following path:

    html/assets/cert

Build the Docker image:

    $ docker build -t passbook .

Running
-------

Run the Docker container:

    $ docker run --name=passbook -h passbook -p 8080:80 -d passbook

Open a browser at:

    http://$(docker-machine ip default):8080
