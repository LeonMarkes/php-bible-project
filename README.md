U biblija.zip je tekst biblije u xml formatu. Biblija se sastoji od 66 knjiga (oznaka <b>), svaka knjiga ima poglavlja  (oznaka <c>), a poglavlja se sastoje od rečenica (stihova) (oznaka <v>). Za podatke iz datoteke napraviti (može u phpMyAdminu) bazu podataka sa tablicama:
    • book (bookID, title) 
    • sentence(chaptID, sentID, content, bookID, updated)
    • origsentence(origID, chaptID, sentID, content, bookID, deleted) – ova arhivska tablica će biti prazna. origID generirati automatski

chaptID i sentID moraju biti preuzeti iz XML-a (oznaka <n>)
Stupac updated ostaje prazan, a kasnije će poslužiti za evidentiranje datuma i vremena ako rečenica bude naknadno mijenjana.
Napraviti PHP skriptu za učitavanje podataka iz datoteke u bazu podataka u napravljene tablice (origsentence ostaje prazna). Pazite da sačuvate odnose među podacima!

Nakon toga napraviti aplikaciju na kojoj se omogućuje ažuriranje rečenica iz biblije. Prije nego korisnik promijeni rečenicu, originalnu je potrebno sačuvati u tablici origsentence. Izmijenjena rečenica ne smije biti kraća od polovice broja znakova rečenice koju se mijenja.  Automatski se u bazu treba pohraniti datum i vrijeme zadnje izmjene.

U aplikaciju učitati dvije liste riječi (pozitivne i negativne) koje se nalaze u opinion-lexicon-English.rar 
Na temelju ovog popisa za svaku rečenicu iz biblije izračunati i prikazati broj pozitivnih i negativnih riječi te njihovu razliku (*).

Također izračunati i prikazati broj pozitivnih i negativnih riječi te njihovu razliku za svako poglavlje svake knjige, te omjer broja pozitivnih i negativnih u odnosu na ukupni broj riječi.
Ispisati top listu 10 najpozitivnijih i nejnegativnijih poglavlja s obzirom na apsolutni broj, te s obzirom na omjer.

Izvještaje prikazati na ekranu, a onaj označen * izvesti u CSV.