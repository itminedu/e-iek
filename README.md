# iek_test_skeleton


### Οδηγός εγκατάστασης έργου ΙΕΚ για ανάπτυξη (development)

## οδηγίες για apache2+drupal

Αρχικά κλωνοποιούμε το repository. Το repository θα πρέπει να τοποθετηθεί σε έναν φάκελο του web server. Συγκεκριμένα ο φάκελος /dist θα πρέπει να βρίσκεται στο webroot του webserver ή vhost. Στην συνέχεια πρέπει να πάμε στον φάκελο /dist/drupal και να αποσυμπιέσουμε εκεί μία εγκατάσταση του drupal 8. (drupal8.2.6 tested). 
συνεχίζεται ....

## οδηγίες για angular
πάμε στο root φάκελο του repository, και εκτελούμε αρχικά (προϋπόθεση να έχουμε εγκαταστήσει το npm)

npm install

στην συνέχεια θα πρέπει να δώσουμε την εντολή

npm start

αυτή η εντολή θα κάνει compile τον κώδικα της angular και θα παραχθούν αρχεία που θα πάνε στο /dist
Στην συνέχεια αν όλα έχουν γίνει σωστά, θα μπορείτε να δείτε την εφαρμογή μέσα από το url
http://..../dist
