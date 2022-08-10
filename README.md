# 1. Einleitung
Die folgende Projektdokumentation legt den Ablauf des IHK-Abschlussprojektes dar, welche
vom Autor im Rahmen seiner Ausbildung zum Fachinformatiker Fachrichtung
Anwendungsentwicklung durchgeführt wurde. Der Ausbildungsbetrieb ist die KIZ Prowina
GmbH mit Hauptsitz in Offenbach am Main, Hessen. Der primäre Tätigkeitsbereich ist die
Begleitung von Menschen auf Ihrem Weg in die Selbständigkeit. Derzeit sind ca. 200 Mitarbeiter
bei der KIZ Prowina an mehreren Standorten beschäftigt.
## 1.1. Projektumfeld
Die Auftraggeber des Projekts ist die KIZ Prowina GmbH. Die KIZ Prowina GmbH ist eines der
führenden Beratungsunternehmen in Deutschland, wenn es um die persönliche und berufliche
Entwicklung sowie den Schritt in die Selbstständigkeit geht. Angesichts der Vielfältigkeit des
Kundenportfolios kommt der Dokumentation bei Projekten, die unter Berücksichtigung der
gesetzlichen Pflichten am Arbeitsmarkt erstellt werden, eine große Bedeutung zu.
## 1.2. Projektziel
Ziel des Projektes ist es, eine effiziente Dokumentenverwaltung zu erstellen, damit die
Mitarbeiter benötigte Dokumente einfach erstellen, bearbeiten und nutzen können. Des
Weiteren sollen die Dokumente über viele Jahre hinweg genutzt und nicht reproduziert werden.
Diese Dokumentenverwaltung soll den Aufwand der Erstellung von Dokumenten minimieren.
## 1.3. Projektbegründung
Aufgrund der vielfältigen Projekte der KIZ Prowina GmbH dient die Dokumentation der Projekte
auch der Wiederverwendung und Weiterentwicklung in neuen Projekten. Damit die
Dokumentation der Projekte über viele Jahre hinweg genutzt und nicht reproduziert werden
muss, ist eine effiziente Dokumentenverwaltung erforderlich. Bei der KIZ Prowina GmbH wird
jedes Projekt von dem zugehörigen Team dokumentiert. Dieser Prozess wird für alle Projekte
ähnlich durchgeführt. Das bedeutet, dass ähnliche Projekte auch ähnliche Dokumentationen
haben und diese bei jedem Projekt neu erstellt werden. Das führt zu einem hohen Zeitaufwand.
Um diesen Aufwand zu minimieren, also um Zeit und um Kosten zu senken, ist ein System zum
Verwalten von Dokumenten erforderlich.
## 1.4. Projektschnittstellen
Das System soll mit PHP und einer MySQL Datenbank umgesetzt werden. Die Datenbank ist
auf dem Server verfügbar, auf dem die Anwendung veröffentlicht wird. Zur Darstellung der
Daten werden diese mit PHP in eine HTML-Seite eingebunden und können dort mit einem TextEditor erstellt, bearbeitet und gelöscht werden.

# 2. Projektplanung
In der Projektplanung wird der Ablauf des Projektes geplant und alle benötigten Ressourcen
strukturiert.

## 2.1. Projektphasen
Der Zeitaufwand des Projektes wurde auf 70 Stunden festgesetzt. Die grobe Zeitplanung ist in
Tabelle 1 dargestellt. Im Anhang A.1 befindet sich eine detaillierte Zeitplanung. In dieser
befinden sich zu den Hauptphasen noch die zugehörigen Unterphasen.

![Screenshot 2022-08-10 125743](https://user-images.githubusercontent.com/73072352/183885127-eb6d2d52-3bfc-4b4a-8d99-247860c34ba5.png)

## 2.2. Ressourcenplanung
Im Anhang A.2 „Verwendete Ressourcen“ sind jene Ressourcen aufgelistet, die für das Projekt
benötigt werden, einschließlich Software, Hardware und Personal. Bei der Auswahl der
Software wurde darauf geachtet, dass diese kostenfrei bzw. Open Source zu der Verfügung
steht oder die KIZ Prowina GmbH bereits über die notwendigen Lizenzen verfügt, um die
Projektkosten möglichst gering zu halten.
## 2.3. Entwicklungsprozess
Vom Autor wurde ein agiler Entwicklungsprozess gewählt, um eine flexible Umsetzung der
Anforderungen zu ermöglichen.
Die Methode ermöglicht die flexible Änderung der Anforderungen und einen fließenden
Entwicklungsprozess. Der agile Entwicklungsprozess gliedert die gesamte Entwicklung in
mehrere Teilprozesse, die nacheinander implementiert und getestet werden. Jeder
abgeschlossene Teilprozess wird validiert, bevor mit dem nächsten Teilprozess begonnen wird.
Die Anwendung wird zunächst mit Hilfe von Visual Studio Code als IDE und XAMPP,
die den Apache-Server und die MySQL-Datenbank bereitstellt, auf dem lokalen Computer
entwickelt und dann auf den Webserver der KIZ Prowina GmbH übertragen. Bei der Entwicklung
der Anwendung werden Datenbanken, Tabellen und Daten verwendet, die gemäß der
tatsächlichen Datenstruktur erstellt werden. Da es sich eine Web-Anwendung handelt, erfolgt
die Programmierung direkt auf dem Webserver.
# 3. Analysephase
In dieser Phase wird der Ist-Zustand ermittelt und das Projekt geprüft, ob es wirtschaftlich und
nutzbar ist. Zusätzlich werden Qualitätsanforderungen und Anwendungsfälle festgelegt.
## 3.1. Ist-Analyse
Wie bereits in Kapitel 1.3 erwähnt, ist die KIZ Prowina GmbH eines der führenden
Beratungsunternehmen in Deutschland, wenn es um die persönliche und berufliche Entwicklung
sowie den Schritt in die Selbstständigkeit geht. Daher spielt es große Rolle über Effektivität und
Kontinuität im Arbeitsmarkt, eine verständliche, regelmäßige und einheitliche Dokumentation zu
erstellen. Dafür sollen Dokumente für jedes Projekt von jedem Mitarbeiter bzw. Team erzeugt
werden können.
Die Dokumente, die jedes Team bzw. jeder Mitarbeiter für ein Projekt benötigt, werden derzeit
manuell erstellt und einem Server abgelegt. Zudem werden die Dokumente im Unternehmen
nicht einfach geteilt, da nur wenige Informationen teamübergreifend geteilt werden. Das
bedeutet, dass ein Dokument oft mehrmals neu angelegt wird und nicht über viele Jahre hinweg
genutzt wird. Es ist auch schwer, ein Dokument zusammen in einem Team (Kollaboration) zu
bearbeiten. Ohne eine Dokumentenverwaltung, entsteht ein hoher Zeitaufwand für jedes Team.
Dieser Aufwand verursacht Kosten und viel Zeit.
Um Zeit und Kosten zu sparen, sollen alle Dokumente eines Projekts in einer Anwendung, mit
der jeder Mitarbeiter einfach Dokumente erstellen, bearbeiten und teilen kann, erstellt werden.
## 3.2. Wirtschaftlichkeitsanalyse
Da aktuell keine zentrale Dokumentenverwaltung existiert, ist eine unternehmensinterne
Umsetzung angedacht. Ob die Realisierung und die damit verbundenen wirtschaftlichen
Aufwendungen gerechtfertigt sind, soll in den folgenden Abschnitten betrachtet werden.
### 3.2.1. Make or Buy-Entscheidung
Aufgrund der Tatsache, dass es sich bei den Prozessen um unternehmensspezifische
Interessen handelt und keine der vorhandenen Anwendungen, die Anforderungen erfüllt, soll
die Lösung durch die Abteilung „Software Entwicklung“ der KIZ Prowina GmbH entwickelt
werden.
### 3.2.2. Projektkosten
Im Folgenden sind die berechneten Kosten aufgeführt, die während der Entwicklung des 
Projekts entstanden sind. Dabei werden sowohl die Personal-, als auch sonstige
Ressourcenkosten berücksichtigt. Die Ressourcenkosten enthalten die Kosten für Hard- und
Softwarenutzung und Arbeitsplatz. Aus Datenschutzgründen dürfen die genauen
Personalkosten nicht herausgegeben werden, deshalb wird die Kalkulation anhand von
recherchierten Stundensätzen durchgeführt. Ein Auszubildender zum Fachinformatiker mit
Fachrichtung Anwendungsentwicklung verdient im dritten Lehrjahr nach IHK-Angaben im
Schnitt 900 € pro Monat, daraus ergibt sich ein Stundenlohn von 6,55 € (IHK Frankfurt, 2022).
Bei 253 Arbeitstagen in 2022, 13 Monatsgehältern und 30 Urlaubstagen ergibt sich der

Stundenlohn wie folgt:

8 h/Tag · 223 Tage/Jahr = 1784 h/Jahr

900 €/Monat · 13 Monate/Jahr = 11700 €/Jahr

11700 €/Jahr / 1784 h/Jahr ≈ 6,55 €/h

Als Ressourcenkosten wurde vom Management eine Pauschale von 15,00 € pro Stunde
festgelegt, die sich aus mehreren Komponenten zusammensetzt. Diese Komponenten
umfassen Stromkosten, Büromietkosten, Anschaffungskosten für Hardware und Software,
Wartungs- und Lizenzkosten für den Server sowie Gemeinkosten. Ein beispielhafter
Stundenlohn eines Mitarbeiters wird 18,80 € eingesetzt. Sämtliche anfallende Projektkosten,
können der folgenden Tabelle entnommen werden.

![Screenshot 2022-08-10 130156](https://user-images.githubusercontent.com/73072352/183885738-4d150506-fce3-4fca-b2bd-b754817c6ae1.png)

### 3.2.3 Amortisationsdauer
Im Folgenden soll geprüft werden, ab welchem Zeitpunkt sich das Projekt amortisiert. Dazu wird
die, durch das Einführen des Produkts, eingesparte Zeit der Mitarbeiter pro Jahr ermittelt. Im
Anschluss wird über den Stundensatz das eingesparte Nutzungsentgelt berechnet und mit den
im vorherigen Abschnitt bestimmten Gesamtkosten die Amortisationsdauer bestimmt. Ein 
Mitarbeiter sollte das Dokument für jedes Projekt und dessen Berechtigungen erstellen. Dafür
muss der Mitarbeiter etwa 1 Stunde am Tag arbeiten. Oben wurde für einen Mitarbeiter eine
beispielhafte Stundenpauschale von 18,80 € pro Stunde angegeben.

Demzufolge;

1 Std. * 18,80 €/Std. = 18,80 € Kosten pro Mitarbeiter/Tag

1711,30 € / 18,80 € = 91,02 ~ 92 Tage

Es gibt ungefähr 22 Arbeitstage pro Monat;

92 Tage / 22 Arbeitstage = 4,18 Monat

Nach 92 Arbeitstage oder ca. 4,2 Monat wird sich das Projekt amortisieren.

## 3.3. Anwendungsfälle
Um die Anwendungsfälle des Projektes zu erfassen, wurde im Zuge der Projektanalyse ein UseCase-Diagramm erstellt. Dabei wurden die betroffenen Akteure identifiziert und deren
Anforderungen ermittelt. Das Use-Case-Diagramm ist im Anhang A.3 zu finden.
## 3.4. Qualitätsanforderungen
# 4. Entwurfsphase
Da es sich bei diesem Projekt um eine Web-Anwendung handelt, liegt der Fokus darauf, dass
die Seite schnell reagiert und keine langen Ladezeiten hat, damit der Benutzer sie nicht als
Störung in der Verbindung deutet. Zudem soll die Anwendung übersichtlich sein und der TextEditor muss alle Anforderungen erfüllen. In Anhang A.4 ist ein Auszug aus dem Lastenheftangegeben, der einige Anforderungen an die Web-Applikation auflistet.
## 4.1. Zielplattform
Die Zielplattform ist in diesem Fall Apache Webserver. Es bietet sich an Web-Applikationen in
PHP zu entwickeln und die Ausgabe mit HTML und CSS zu implementieren. Auf dem
Webserver ist PHP Version 7.1.33 installiert. Die für die Datenbank benötigte
Auszeichnungssprache mysql liegt in der Version 5.0.1.2 vor. Die Daten werden mittels PHP in
eine SQL Datenbank geschrieben. Die Seite soll nur über die Web-Applikation Inthepro der KIZ
Prowina GmbH erreichbar sein.
## 4.2. Architekturdesign
Die SQL-Datenbank wird mit dem Tool „HeidiSQL“ erstellt. PHP ist eine serverseitige
Programmiersprache. Das bedeutet, dass sie nicht auf den Clients ausgeführt wird, sondern
direkt auf dem Server und nur die gewünschten Werte an den Client übertragen
werden. Dadurch ist die Anwendung weniger anfällig gegenüber Manipulationen von außen.
## 4.3. Entwurf der Benutzeroberfläche
Um die Benutzerfreundlichkeit zu gewährleisten, soll die neue Benutzeroberfläche an die bereits
bestehenden Inthepro angepasst werden. Der Zugriff auf die Anwendung erfolgt
Anmeldesystem durch Eingabe von Benutzernamen und Kennwort. Auf der Benutzeroberfläche
sollen zwei Dropdown-Menüs als Filter zur Verfügen stehen. Über das Dropdown-Menü kann
der Benutzer Unternehmensbereiche und Dokumenttypen auswählen. Beide Filter können auch
kombiniert werden. Zusätzlich gibt es ein Eingabefeld, dass als Volltextsuche genutzt werden
soll um den Inhalt von Dokumente durchsuchen zu können. Die gefilterten Ergebnisse sollen in
einer Tabelle angezeigt werden. Zudem soll der Benutzer die Möglichkeit haben über einen
Button ein neues Dokument anzulegen, dabei sollen auch schon die Rechte am Dokument für
andere Benutzer festgelegt bzw. später auch aktualisiert werden.
Auf der Hauptseite sollen nur Dokumente angezeigt werden können, auf die der Benutzer ein
Zugriff hat. Der Benutzer kann die Dokumente entweder nur lesen oder lesen, bearbeiten und
löschen. Je nach Zugriffsrecht sollen neue Kapitel und Inhalte in dem Dokument eingefügt
werden können.
Dazu soll die Anwendung über einen Button verfügen. Wenn dieser Button geklickt wird, soll ein
Popup angezeigt werden. In diesem Popup soll der Benutzer den Inhalt erstellen und zusätzlich
eine Datei als Anhang einfügen können. Der Benutzer soll mit anderen Buttons das Dokument
löschen oder als pdf-Datei exportieren können. Die erstellten Inhalte sollen jeder Zeit aktualisiert oder gelöscht werden können. Über einen
Informationsbutton kann jeder Information über das gewählte Dokument erhalten, z.B.: wer das
Dokument angelegt hat und wer das Dokument bearbeitet hat und den letzten
Bearbeitungszeitpunkt.
Zur Bearbeitung der Dokumente soll ein Echtzeiteditor als Texteditor verwendet werden.
Anhand der Entscheidungsmatrix in Tabelle 3 wurde für den Echtzeiteditor die Applikation
„Trumbowyg“ ausgewählt.

![Screenshot 2022-08-10 131634](https://user-images.githubusercontent.com/73072352/183888260-2e6021a1-4518-49bb-aa40-15b9e44f7d5c.png)

## 4.4. Datenmodell
In der bestehenden Datenbank müssen zusätzlich fünf Tabellen („unterlagen, bereich, typ,
kapitel, recht") angelegt werden. Die Entitätstypen aus dem ausgearbeiteten EntityRelationship-Model (ERM) ist in Anhang A.5 dargestellt. Für die Verwendung des ERM als
relationale Datenbank wurde dieses in ein Tabellenmodell überführt (Anhang A.6).
## 4.5. Geschäftslogik
Zur Verdeutlichung der Hauptfunktionen wurden Programmablaufpläne erstellt. Sie
veranschaulichen den detaillierten Ablauf einzelner Programmfunktionen und sind in Anhang
A.7 dargestellt. Nach Fertigstellung des Projekts wird eine Verknüpfung zu der
Dokumentenverwaltung in der Inthepro platziert, um sie für die Mitarbeiter zugänglich zu
machen.
## 4.6. Pflichtenheft
Zum Abschluss der Entwurfsphase wurde ein Pflichtenheft erstellt, dieses beschreibt wie die
Anforderung umgesetzt werden sollen und dient damit als Strukturgeber für die Erstellung des
Projektes. Im Anhang A.8 ist ein Auszug aus dem Pflichtenheft abgebildet.

# 5. Implementierungsphase
## 5.1. Implementierung der Datenstrukturen
Auf Grundlage, des in Kapitel 4.4 definierten Datenmodells, wurden zunächst in der Datenbank
die zugehörigen Tabellen erstellt. Die Spalten wurden mit SQL-Befehlen manuell in die
jeweiligen Tabellen eingefügt. Alle Tabellen werden dynamisch über das zu erstellende System
gefüllt. Nur die Tabellen „bereich und typ“ wurden manuell befüllt.
Die Datenbank wurde anhand des in Anhang A.6 dargestellten Tabellenmodells erstellt und
erfüllt somit alle notwendigen Bedingungen aus der Entwurfsphase.
## 5.2. Implementierung der Benutzeroberfläche
Die Benutzeroberfläche wurde analog zum internen Webportalen generiert, wie bereits in
Kapitel 4.3 beschrieben. Als Grundlage dienten vorgegebene Farbcodes und CSSEinstellungen, ebenso wie ein vorgefertigtes Hintergrundbild für den Titel. Die Struktur der
einzelnen Seiten wurde nur in das HTML-Template eingebunden. Die Seiten wurden mit im PHP
eingebettetem HTML in das Template eingebunden, was die Flexibilität im Seitenaufbau erhöht.
Auf der Seite, mit der Darstellung der Übersicht, stehen zwei Dropdown-Menüs als Filter zur
Verfügung. Über das Dropdown-Menü wählt der Benutzer den Unternehmensbereich und den
Dokumententyp. Beide Filter können auch kombiniert werden. Zusätzlich gibt es ein
Eingabefeld, dass als Volltextsuche genutzt wird um den Inhalt von Dokumenten durchsuchen
zu können. Die gefilterten Ergebnisse werden in einer Tabelle angezeigt. Zudem hat der
Benutzer die Möglichkeit über einen Button ein neues Dokument anzulegen, dabei werden auch
die Zugriffsrechte des Dokumentes für andere Benutzer festgelegt bzw. später auch aktualisiert.
Je nach Berechtigung können neue Kapitel und Inhalte in das Dokument eingefügt werden.
Dazu verfügt die Anwendung über einen Button. Wenn dieser Button gedrückt wird, öffnet sich
ein Popup. In diesem Popup erstellt der Benutzer den Inhalt und zusätzlich kann eine Datei als
Anhang eingefügt werden.
Der Benutzer kann das Dokument als pdf-Datei exportieren oder über anderen Button löschen.
Die erstellten Inhalte können jeder Zeit aktualisiert oder gelöscht werden. Dazu verfügt die
Anwendung auf dieser Seite über die benötigten Buttons. Ein Informationsbutton zeigt die
Information über das gewählte Dokument, z.B.: wer das Dokument angelegt hat, wer das
Dokument bearbeitet hat und den letzten Bearbeitungszeitpunkt. Zur Bearbeitung der
Dokumente wird ein WYSIWYG-Editor verwendet. Screenshots der fertigen GUI sind im Anhang
A.9 zu finden.
## 5.3. Implementierung der Geschäftslogik
In diesem Abschnitt wird das Projekt in Übereinstimmung mit Pflichtenheft, Zeit- und
Ressourcenplanung, ausgewählten Entwicklungswerkzeugen und Ablaufplan durchgeführt.
Um beim Start standardmäßig die aktuellen Dokumente aus der Datenbank zu laden, wird eine
Funktion recht_control() ausgeführt, über die beim Ausführen die Berechtigung des Benutzers
kontrolliert wird, dann eine weitere Funktion an die entsprechende PHP-Datei ausgeführt. Diese
Funktion übernimmt die Daten: Benutzername, Datenbankname und Passwort. Dann wird eine
Verbindung mit der Datenbank hergestellt. Über die Methode databasequery() werden die
Datensätze des Benutzers aus der Datenbank abgefragt und mittels PHP angezeigt.
Danach werden die Dokumente, auf die der Benutzer Zugriff hat, in einer Tabelle angezeigt. Der
Benutzer kann ein Dokument auswählen und dann bearbeiten oder lesen. Mit dieser Tabelle
hat der Benutzer auch Möglichkeit, um die Dokumente zu filtern. Dafür entsteht zwei Filter:
Unternehmensbereich und Dokumenttyp. Beide Filter können auch kombiniert werden.
Zusätzlich gibt es ein Eingabefeld, dass als Volltextsuche genutzt wird, um den Inhalt von
Dokumente durchsuchen zu können. Die gefilterten Ergebnisse werden in dieser Tabelle
angezeigt.
Im nächste Schritt können die Dokumente und Kapitel erstellt, aktualisiert, gelöscht,
heruntergeladen und auch als PDF-Datei exportiert werden.
Beim Erstellen des Dokumentes gibt der Benutzer Mithilfe eines Formular der Name, der
Unternehmensbereich und der Dokumententyp an. Danach stellt der Benutzer die Zugriffsrechte
für das Dokument ein.
Beim Erstellen eines Kapitels wird die Applikation „Trumbowyg" als WYSIWYG-Editor
verwendet. Trumbowyg ist ein Open-Source-Software und kostenlos nutzbar. Bei dieser wird
das Dokument während der Bearbeitung am Bildschirm genauso angezeigt, wie es auch
gedruckt aussehen wurde. Der Benutzer gibt für jedes Kapitel eine Kapitelnummer an. Wenn
ein Kapitel gelöscht wird, dann werden alle Kapitelnummern automatische neu nummeriert. Der
Benutzer kann in jedem Kapitel einen Anhang hinzufügen. Dafür wird die Funktion
move_uploaded_file() verwendet. Diese Funktion prüft, ob die angehängte Datei eine gültige
Upload-Datei ist. Auf der Anzeigeseite des Dokumentes kann die beigefügte Datei
heruntergeladen werden.
Beim Exportieren eines Dokumentes wird eine Klasse „TCPDF“ verwendet. TCPDF ist ein
kostenloses Open-Source-Projekt zum Generieren von PDF-Dokumenten aus HTML und PHP.
Mithilfe der Klasse „TCPDF“ sind für die Grundfunktionen keine weiteren externen Bibliotheken 
erforderlich. Seitenformat, Ränder und Maßeinheiten für das Dokumentenlayout werden mit
dieser Klasse erstellt.
Für jedes Dokument und dessen Kapiteln werden zusätzliche Informationen gespeichert, z.B.:
„Wer hat das Dokument erstellt“, „Wann wurde das Dokument erstellt“, „Wer hat das Dokument
zuletzt bearbeitet“ und „Wann wurde das Dokument zuletzt bearbeitet“.
Alle gewählten Aktionen werden in einem Popup angezeigt. In dieser Phase werden auch die
Methoden erstellt, die für eine benutzerfreundliche Oberfläche erforderlich sind. Dafür wird die
freie JavaScript-Bibliothek jQuery verwendet. jQuery bietet eine einfache Syntax für
XMLHttpRequests, JavaScript-Objekte, die zum Übertragen von Daten über HTTP verwendet
werden und viele weitere nützliche Funktionen.
Die Ausschnitte des Quellcodes befinden sich im Anhang A.10.

# 6. Abnahmephase
Die Abnahme des Projektes fand zu verschiedenen Punkten während der Entwicklung statt.
Die erste Abnahme fand nach der ersten Integration der Seiten in das HTML-Template statt,
aufgrund der agilen Softwareentwicklungsmethode wurde dann nach jeder Iteration eine neue
Version zur Abnahme freigegeben.
Zum Zeitpunkt der Endabnahme des Projektes war die Oberfläche bereits bekannt und so lag
der Fokus darauf, dass die aufgetretenen Fehler der letzten Version behoben wurden.
Es wird sichergestellt, dass alle Schaltflächen, Menüs, Tabellen und Informationen auf der
Benutzeroberfläche so gestaltet sind, dass sie für den Benutzer intuitiv sind, und dass
informative Notizen oder Abbildungen verwendet werden. Durch die frühe Integration aller
Beteiligten in den Entwicklungsprozess konnten Anregungen und Kritikpunkte zeitnah
umgesetzt werden.

# 7. Dokumentation
Die Benutzerdokumentation ist, aufgrund der Tatsache, dass Nutzereingaben nur bedingt
möglich sind und die Oberfläche intuitiv gehalten wurde, kurz. Nach sorgfältiger Prüfung der
Benutzerdokumentation, wurde diese veröffentlicht. Sie erklärt die Funktionen der Seiten und
enthält nähere Informationen über die Darstellung der ausgegebenen Daten. Ein Ausschnitt ist
in Anhang A.11 dargestellt.

# 8. Fazit
## 8.1. Soll-/Ist-Vergleich
Rückblickend betrachtet wurden alle im Pflichtenheft festgelegten Anforderungen an das IHKProjekt umgesetzt. Der in Kapitel 2.1 erstellte Projektplan wurde eingehalten, wie der Soll-/IstVergleich in Tabelle 4 zeigt. Es konnte bei der Analysephase und bei der Entwurfsphase etwas
Zeit eingespart werden, diese Einsparung relativierte sich mit der längeren
Implementierungsphase, sodass das Projekt in dem von der IHK vorgegebenen Zeitrahmen von
70 Stunden umgesetzt werden konnte.

![Screenshot 2022-08-10 132202](https://user-images.githubusercontent.com/73072352/183889139-421c3030-48e5-42c7-9908-56fc980d06c0.png)

## 8.2. Gewonnene Erkenntnisse
Das Projekt ermöglichte es, den Ablauf eines Softwareprojekts von Anfang bis Ende zu
betrachten. Der wichtigste Faktor war nicht nur, in direkten Programmieraufgaben aktiv zu sein,
sondern auch in erster Linie für die genaue Definition der technischen Anforderungen, die
Auswahl des Entwicklungsprozesses und das Management der einzelnen Projektphasen
verantwortlich zu sein. Darüber hinaus konnte wichtige Erfahrung im Bereich PHPProgrammierung und der MySQL-Datenbank gesammelt werden.
## 8.3. Ausblick
Innerhalb des Projektes wurde eine Lösung für ein Dokumentenverwaltungssystem in
Verbindung mit einer MySQL Datenbank entwickelt. Nach den im Lastenheft definierten
Anforderungen, wurde alles im vorgegebenen Rahmen umgesetzt.
Zukünftig kann die Benutzeroberfläche nach Feedback den Mitarbeitern weiterentwickelt
werden. Es können zum Beispiel neu Filter nötig werden, die kombiniert werden müssen. Evtl.
wird auch eine Mail-Funktion zum automatischen Versenden der Dokumente nötig sein. Durch
den modularen Aufbau bzw. die modulare Anbindung des WYSIWYG-Editors „Trumbowyg“
kann dieser schnell aktualisiert bzw. ersetzt werden, falls er die neu entstehenden Bedürfnisse
nicht mehr erfüllt. 

# Literaturverzeichnis

### IHK Frankfurt, 2022. IHK Frankfurt a. Main: Die Ausbildungsvergütung. [Online]

Available at: https://www.frankfurt-main.ihk.de/aus-undweiterbildung/ausbildung/ausbildungsberatung/ausbilderinfos/die-ausbildungsverguetung5183908

[Zugriff am 28 März 2022]

### Gehaltsübersicht 2022. [Online]

Available at https://gehaltsfrage.de/gehalt/anwendungsentwickler

[Zugriff am 28 März 2022]

### Riel, M. v., 2016. PHP Documentor. [Online]

Available at: https://www.phpdoc.org/

[Zugriff am 28 März 2022]

### Trumbowyg Documentation [Online]

Available at: https://alex-d.github.io/Trumbowyg/documentation/

[Zugriff am 29 März 2022]

### TCPDF

Available at: https://tcpdf.org/

[Zugriff am 29 März 2022]



# Anhang
## A1 Detaillierte Zeitplanung

![Screenshot 2022-08-10 132425](https://user-images.githubusercontent.com/73072352/183889627-b739277c-c4ff-48a4-a188-438b58a2a023.png)

## A2 Verwendete Ressourcen
### Hardware
- Büroarbeitsplatz mit Laptop und Monitor und Anbindung an das interne Netzwerk
- Laptop mit Intel AMD A4-9125 RADEON R3, 4 COMPUTE CORES 2C+2G Prozessor (
2.3GHz) und 8 GB RAM

### Software
- Windows 10 Education x64
- Visual Studio Code
- PHP Tools für Visual Studio Code
- ysql
- Microsoft Office 2016
- Apache Webserver
- HP 7.1.33
- MySQL Datenbank
- rumbowyg - A lightweight WYSIWYG Editor
- TCPDF

### Personal
- Entwickler – Umsetzung des Codes
- Mitarbeiter – Review des Codes, Hilfestellungen und Abnahme des Projekts

## A3 Use - Case Diagramm
![Screenshot 2022-08-10 132748](https://user-images.githubusercontent.com/73072352/183890239-7084148b-7409-4fe4-ada2-ad5c103b303a.png)

## A4 Lastenheft (Auszug)

Im folgenden Auszug aus dem Lastenheft werden die Anforderungen definiert, die die zu
entwickelnde Anwendung erfüllen muss.
### Anforderungen
Von der Anwendung müssen folgende Anforderungen erfüllt werden:
- Die Anwendung muss die Daten in eine MySQL-Datenbank importieren.
- Die Anwendung muss die Daten aus den Tabellen der MySQL-Datenbank auf einer
internen Webseite darstellen, aktualisieren und löschen.
- Die Anwendung muss über einen WYSIWYG-Editor verfügen, der alle Eigenschaften
haben soll, um ein Dokument zu erstellen.
- Die Anwendung muss die Daten aus der MySQL-Datenbank im WYSIWYG-Editor der
Webseite korrekt(formatiert) darstellen.
- Die Anwendung muss die Daten validieren und danach speichern.
- Die Ausgabe der Daten auf der internen Webseite muss durchsuchbar sein und sich
neu anordnen lassen.
- Die Anwendung muss die Dokumente als PDF exportieren.
- Die internen Webseiten und Dokumente müssen in der Corporate Identity dargestellt
werden.
[…]

## A5 Datenbankmodell

![Screenshot 2022-08-10 133002](https://user-images.githubusercontent.com/73072352/183890606-1f5dc671-e60c-44ed-8a9e-d2ecae5c54a7.png)

## A6 Tabellenmodell

![Screenshot 2022-08-10 133119](https://user-images.githubusercontent.com/73072352/183890782-b2dcdd52-a158-4de2-9656-f3fba4f16411.png)

## A7 PAP – Diagramm

![Screenshot 2022-08-10 133226](https://user-images.githubusercontent.com/73072352/183891014-a0f28421-ec17-4cc2-9f0b-94c567c68fa3.png)

## A8 Pflichtenheft (Auszug)

In folgendem Auszug aus dem Pflichtenheft wird die geplante Umsetzung der im Lastenheft
definierten Anforderungen beschrieben:
### Umsetzung der Anforderungen
- Das Dropdown - Menu: Zeigt eine Liste der Dokumente an
  - In dem Menu müssen die Unternehmensbereiche und Dokumenttypen vom
Benutzer ausgewählt werden.
  - Unter jedem Unternehmensbereich müssen die Dokumenttypen gelistet
werden.
  - Unter jedem Dokumenttypen müssen die Dokumente gelistet werden.
  - Die Dokumente, die unter jedem Dokumenttypen gelistet werden, müssen vom
Benutzer ausgewählt werden.
- Die Tabelle: Auf der Seite „Übersicht“ muss die Anwendung die Daten der Unterlagen
in einer Tabelle darstellen.
  - Es muss möglich sein, die Unterlagen nach Unternehmensbereich und
Dokumenttyp in der Tabelle zu filtern
  - Es muss möglich sein, beide Filter zu kombinieren.
  - Es muss möglich sein, die Volltextsuche zu benutzen, um nach der Überschrift
oder in den Dokumenten zu suchen
  - Es muss möglich sein, die gefilterten Ergebnisse in einer Tabelle anzuzeigen.
- Es muss möglich sein, das ausgewählte Dokument auf der Webseite anzuzeigen
- Es muss möglich sein, die Dokumente zu bearbeiten, zu löschen und neue Kapitel zu
erstellen
- Es muss möglich sein, das ausgewählte Dokument als PDF-Datei zu exportieren
[…]

## A9 Screenshots der Benutzeroberflächen

![Screenshot 2022-08-10 133447](https://user-images.githubusercontent.com/73072352/183891442-e908ff37-e1c3-42a7-814e-d5ee947c70e1.png)

![Screenshot 2022-08-10 133531](https://user-images.githubusercontent.com/73072352/183891601-16c8cb1d-53fe-427c-9387-995e2139d2ae.png)



