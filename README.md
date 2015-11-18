Passbook Service
================

Simple PHP Service for Passbook creation.

Building
--------

Put your .p12 certificate in the following path:

    html/assets/cert

Build the Docker image:

    $ docker-compose build

Running
-------

Run the Docker container:

    $ docker-compose up -d

Open a browser at:

    http://$(docker-machine ip default):8080
