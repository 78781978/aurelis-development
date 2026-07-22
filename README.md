# Aurelis Development — strona WWW

Statyczna strona internetowa (HTML/CSS/JS, bez frameworków i bez procesu budowania) dla **Aurelis Development Sp. z o.o.** — generalnego wykonawcy inwestycji mieszkaniowych i przemysłowych działającego na terenie Małopolski.

Wszystkie pliki leżą płasko, w jednym folderze — bez podfolderów. To celowe: dzięki temu wgrywanie na GitHub (przez przeglądarkę, także z telefonu) jest niezawodne — po prostu zaznaczasz wszystkie pliki i przeciągasz je razem, bez ryzyka, że jakiś podfolder "zgubi się" po drodze.

## Struktura plików

```
index.html          — Strona główna
o-nas.html            — O nas
uslugi.html           — Usługi (10-punktowy zakres generalnego wykonawstwa)
realizacje.html       — Realizacje / galeria
praca.html            — Praca — profil firmy + oferta "Pracownik budowlany"
kontakt.html          — Kontakt (dane + formularz + mapa)
regulamin.html        — Regulamin strony internetowej
polityka-prywatnosci.html — Polityka prywatności (RODO) + sekcja cookies
style.css              — Cały styl strony (kolory, layout, animacje, responsywność)
script.js               — Menu mobilne, scroll-reveal, licznik statystyk, baner cookies, formularz kontaktowy (demo), rok w stopce
logo.svg                 — Logo (pełna wersja, odtworzone na podstawie przesłanej grafiki)
logo-mark.svg            — Sam znak graficzny (używany jako favicon)
hero-bg.svg               — Placeholder zdjęcia w sekcji hero
about-bg.svg              — Placeholder zdjęcia (używany tylko przy 3 kartach zespołu na o-nas.html)
zespol.png                — Prawdziwe zdjęcie użyte jako "zdjęcie zespołu" na stronie głównej
budowa.png                — Prawdziwe zdjęcie placu budowy użyte w sekcji "Nasza historia" na o-nas.html
realizacja-01.svg … realizacja-06.svg  — Placeholdery zdjęć realizacji (6 szt.)
robots.txt                — Konfiguracja dla robotów wyszukiwarek
sitemap.xml                — Mapa strony (SEO)
```

## Dane firmowe

Zaktualizowano na dane rzeczywiste przekazane przez klienta:

- **Aurelis Development Sp. z o.o.**
- Adres: **ul. Warszawska 53, 32-091 Michałowice** — uwaga: klient podał adres jako "Ul. Warszawka 53"; przyjęto, że to literówka i chodzi o ul. **Warszawską** (bardzo częstą nazwę ulicy w polskich miejscowościach) — warto to jeszcze zweryfikować przed publikacją.
- E-mail: **biuro@aurelis.com.pl**
- Telefon: **+48 512 133 322** (komórkowy) oraz **+48 12 373 99 89** (stacjonarny) — widnieją w nagłówku, stopce, `kontakt.html` i przycisku CTA na `praca.html`.
- NIP: **675-154-51-05** — podany na `kontakt.html` oraz w `polityka-prywatnosci.html`.
- Teren działalności: **Małopolska** (poprzednio było zawężone do "Kraków i okolice" — treść na stronie została odpowiednio poszerzona)

## Dane, które NADAL są PRZYKŁADOWE — do podmiany

- **KRS i REGON** — spółka nie przekazała jeszcze tych danych; `polityka-prywatnosci.html` jawnie to zaznacza.
- Zdjęcie hero oraz 6 zdjęć realizacji — to nadal grafiki-placeholdery z podpisem, do podmiany na prawdziwe fotografie. Zdjęcie zespołu na stronie głównej (`zespol.png`) zostało już podmienione na przesłaną przez klienta fotografię.
- Opinie klientów na stronie "Realizacje" — przykładowe, do zamiany na prawdziwe.
- Statystyki (120+ projektów, 12 lat, 35 osób w zespole, 98% poleceń) — orientacyjne, do zaktualizowania realnymi danymi.

## Pinezka na mapie (kontakt.html)

Środowisko, w którym pracuję, nie ma dostępu do usług geokodowania (np. Nominatim/Google) — nie mogłem więc automatycznie zweryfikować dokładnych współrzędnych GPS dla „ul. Warszawska 53". Mapa jest teraz mocno przybliżona (zoom) do centrum miejscowości Michałowice, ale pinezka **nie jest zweryfikowana co do konkretnego numeru budynku**. Zalecam samodzielnie sprawdzić adres w Google Maps i, jeśli pinezka jest przesunięta, podać mi dokładne współrzędne (lat, lon) albo bezpośredni link do lokalizacji — podmienię `bbox` i `marker` w `kontakt.html`.

## Strona "Praca"

Nowa podstrona `praca.html` łączy dwie rzeczy przekazane przez klienta: krótkie przedstawienie zakresu działalności firmy (kontekst pracodawcy) oraz treść konkretnej oferty pracy "Pracownik budowlany" (35–45 zł netto/h, benefity, wymagania, CTA do zadzwonienia lub wysłania CV mailem). Dodano do nawigacji i stopki na wszystkich podstronach.

## Animacje i redesign premium

- Sekcje i karty pojawiają się z animacją "reveal" przy przewijaniu (`.reveal` w HTML + `IntersectionObserver` w `script.js`).
- Statystyki (`data-count`) liczą się od zera przy wejściu w widok.
- Hero i nagłówki podstron mają subtelny motyw architektoniczny (linie siatki + ukośny akcent w kolorach logo) zamiast płaskiego tła.
- Przyciski mają efekt "przebłysku" (shine) przy najechaniu.

## SEO — słowa kluczowe

Każda podstrona ma teraz dedykowany `<meta name="keywords">` dopasowany do jej treści (np. `uslugi.html` — pełna lista 10 usług generalnego wykonawstwa, `praca.html` — frazy związane z ofertą pracy). Dodano też `robots.txt` i `sitemap.xml` — **uwaga:** oba pliki wskazują na domenę `https://aurelis.com.pl/`, przyjętą na podstawie adresu e-mail firmy (`biuro@aurelis.com.pl`); jeśli docelowa domena strony jest inna, podmień adres w obu plikach.

## Regulamin, polityka prywatności i cookies

- `regulamin.html` — zasady korzystania ze strony (definicje, zakres usług, formularz kontaktowy/rekrutacyjny, prawa autorskie, odpowiedzialność, reklamacje).
- `polityka-prywatnosci.html` — polityka prywatności zgodna z RODO (administrator danych, cele i podstawy przetwarzania, prawa osób, których dane dotyczą) wraz z sekcją **Cookies** (`#cookies`) opisującą cookies niezbędne i analityczne.
- Oba dokumenty mają jawnie oznaczone pola **NIP / KRS / REGON „do uzupełnienia"** — spółka nie przekazała jeszcze tych danych rejestrowych.
- **Baner zgody na cookies** — pojawia się na dole każdej podstrony przy pierwszej wizycie (przyciski „Akceptuj wszystkie" / „Tylko niezbędne"), zapamiętuje wybór w `localStorage` (klucz `aurelisCookieConsent`) i nie pokazuje się ponownie. Obecnie strona nie używa żadnych cookies analitycznych (np. Google Analytics) — mechanizm jest przygotowany na przyszłość, gdyby taka usługa została dodana.

## Jak podmienić zdjęcie

Podmień plik (np. `realizacja-01.svg`) na własne zdjęcie. Jeśli nowy plik ma inną nazwę lub rozszerzenie (np. `.jpg`), zaktualizuj też odpowiedni atrybut `src="..."` w pliku `.html`, w którym to zdjęcie jest użyte.

## Formularz kontaktowy

Formularz na stronie `kontakt.html` jest **demonstracyjny** — obecnie tylko pokazuje komunikat po stronie przeglądarki i nie wysyła maila. Aby zaczął realnie wysyłać wiadomości, najprościej podłączyć darmową usługę typu [Formspree](https://formspree.io) lub [EmailJS](https://www.emailjs.com) (podmiana `action` formularza w `kontakt.html`).

## Mapa

W sekcji kontaktowej użyto darmowej mapy OpenStreetMap (bez klucza API), wyśrodkowanej na Michałowicach (gmina w powiecie krakowskim). Po weryfikacji dokładnego adresu siedziby warto doprecyzować współrzędne w `kontakt.html` (`bbox` i `marker`).

## Publikacja (GitHub Pages) — od zera

1. Na [github.com](https://github.com) usuń istniejące repozytorium `aurelis-development`, jeśli już próbowałaś je zakładać wcześniej (Settings repozytorium → na samym dole → Delete this repository), i utwórz je ponownie (przycisk **+** → **New repository** → nazwa `aurelis-development` → Create).
2. Na stronie nowego, pustego repozytorium kliknij **uploading an existing file**.
3. Zaznacz **wszystkie pliki** z tego folderu (na komputerze: Ctrl+A / Cmd+A) i przeciągnij je razem na stronę GitHuba.
4. Kliknij **Commit changes**.
5. Wejdź w **Settings** repozytorium → **Pages**, jako źródło ("Source") wybierz **Deploy from a branch**, branch **main**, folder **/ (root)** → **Save**.
6. Po 1–2 minutach strona będzie dostępna pod adresem `https://<twoja-nazwa-uzytkownika>.github.io/aurelis-development/`.

Docelowo można też podpiąć własną domenę (np. `aurelisdevelopment.pl`) w tych samych ustawieniach Pages.

## Wersja WordPress (motyw `wp-theme/aurelis-development`)

Ta sama strona jest dostępna też jako **pełny, samodzielny motyw WordPress** — folder `wp-theme/aurelis-development/`. To nie jest statyczny "przepisany na PHP" HTML, tylko prawdziwy motyw z panelem administracyjnym: dane firmy, realizacje, opinie klientów i teksty na stronie głównej można edytować z poziomu `wp-admin`, bez dotykania kodu. Motyw nie wymaga żadnych dodatkowych wtyczek (formularz kontaktowy, karuzele itd. działają natywnie).

### Instalacja

1. Spakuj **zawartość** folderu `wp-theme/aurelis-development/` do pliku `.zip` (tak, by po rozpakowaniu plik `style.css` znalazł się bezpośrednio w folderze motywu, a nie o poziom głębiej).
2. W `wp-admin` → **Wygląd → Motywy → Dodaj nowy → Wyślij motyw** → wskaż ten `.zip` → **Zainstaluj**, a następnie **Włącz**.
   (Alternatywnie: wgraj folder `aurelis-development` bezpośrednio przez FTP/SFTP do `wp-content/themes/`.)

### Konieczna konfiguracja po instalacji

Po włączeniu motywu strona nie będzie jeszcze wyglądać poprawnie, dopóki nie wykonasz poniższych kroków — WordPress musi wiedzieć, które Strony odpowiadają którym szablonom:

1. **Utwórz Strony** (Strony → Dodaj nową) z **dokładnie takimi adresami (slug)**, jak niżej — motyw dobiera szablon automatycznie po slugu:
   - `o-nas`
   - `uslugi`
   - `realizacje`
   - `praca`
   - `kontakt`
   - `polityka-prywatnosci`
   - `regulamin`
   
   Tytuł i treść każdej Strony możesz wypełnić dowolnie (treść części z nich i tak jest w dużej mierze generowana przez szablon — patrz sekcja "Co jest edytowalne" niżej), ale **slug musi się zgadzać**, inaczej WordPress użyje domyślnego, generycznego `page.php`.
2. **Ustaw stronę główną**: Ustawienia → Czytanie → "Strona główna wyświetla" → **Statyczna strona** → jako "Strona główna" wybierz dowolną utworzoną Stronę (może być pusta/nowa "Strona główna") — to aktywuje `front-page.php` wraz z jego polami hero w edytorze.
3. **Skonfiguruj menu**: Wygląd → Menu → utwórz menu z linkami do powyższych Stron i przypisz je do lokalizacji **"Menu główne"**. Jeśli menu nie zostanie przypisane, motyw pokaże domyślne menu awaryjne (te same pozycje, na sztywno).
4. **Uzupełnij dane firmy**: Wygląd → Personalizacja (Customizer) → sekcja **"Dane firmy Aurelis"** → telefony, e-mail, NIP, nazwa spółki, link do mapy (embed OSM/Google), statystyki na stronie głównej (liczba projektów, lat, osób w zespole, % poleceń) oraz tekst "O firmie" w stopce.
5. **Dodaj realizacje**: w menu bocznym pojawi się nowy typ treści **Realizacje** — każdy wpis to tytuł + zdjęcie wyróżniające (miniatura) + opis. Widoczne na stronie `realizacje`.
6. **Dodaj opinie klientów**: analogicznie typ treści **Opinie klientów** — tytuł (imię/nazwa klienta) + treść (sama treść opinii, bez cudzysłowów — motyw dodaje je automatycznie). Też widoczne na stronie `realizacje`.
7. Formularz kontaktowy na stronie `kontakt` wysyła e-mail przez wbudowaną funkcję WordPressa (`wp_mail`) na adres e-mail ustawiony w kroku 4 — działa od razu, o ile serwer hostingowy ma poprawnie skonfigurowaną wysyłkę poczty (część hostingów wymaga wtyczki SMTP, np. WP Mail SMTP, żeby maile nie trafiały do spamu — to standardowa praktyka przy każdym motywie WP, nie specyfika tego).

### Co jest edytowalne z panelu, a co nie

**Edytowalne bez dotykania kodu:**
- Dane kontaktowe firmy, statystyki, link do mapy, tekst stopki (Customizer).
- Realizacje i opinie klientów (osobne typy treści, dowolna liczba wpisów).
- Nagłówek (hero) strony głównej — eyebrow, dwie linie nagłówka, lead (pole meta w edytorze Strony głównej).
- Podtytuł pod nagłówkiem na każdej podstronie (pole meta w edytorze każdej Strony).
- Stawka i lokalizacja oferty pracy na stronie `praca` (pola meta w edytorze tej Strony).
- Główna treść tekstowa podstron (edytor Strony — tam, gdzie szablon korzysta z `the_content()`).

**Wymaga edycji kodu szablonu (świadomie zostawione jako "twarde" elementy układu, żeby uniknąć rozjechania layoutu bez wtyczek typu ACF):**
- Siatka 6 kart usług na stronie głównej i pełna lista usług na `uslugi`.
- Struktura list/checklisty (np. wymagania i benefity na `praca`, zakres regulaminu).
- Układ i liczba kolumn/sekcji na poszczególnych stronach.

### Ograniczenia testowania w tym środowisku

Ten motyw był tworzony i weryfikowany w piaskownicy bez dostępu do internetu na zewnątrz (m.in. `wordpress.org` jest zablokowane), więc **nie było możliwe zainstalowanie prawdziwego WordPressa i przetestowanie motywu "na żywo"**. Zamiast tego zweryfikowano go dwoma metodami:
- `php -l` (lint składni) na każdym pliku `.php` motywu — zero błędów składniowych.
- Własny, uproszczony zestaw funkcji-atrap WordPressa (nie prawdziwy rdzeń WP), który uruchamia rzeczywisty kod motywu i wyłapuje błędy krytyczne / brakujące funkcje — wszystkie szablony oraz logika Customizera, typów treści, pól meta i formularza kontaktowego przeszły ten test bez błędów.

To **nie zastępuje** testu na prawdziwej instalacji WordPress. Zalecane jest zainstalowanie motywu na testowym WordPressie (lokalnie, np. przez LocalWP, albo na hostingu) przed publikacją produkcyjną, żeby zweryfikować wygląd i działanie formularza "na żywo".
