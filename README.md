# Aurelis Development — strona WWW

Statyczna strona internetowa (HTML/CSS/JS, bez frameworków i bez procesu budowania) dla przykładowej firmy budowlanej **Aurelis Development** (Kraków i okolice).

Wszystkie pliki leżą płasko, w jednym folderze — bez podfolderów. To celowe: dzięki temu wgrywanie na GitHub (przez przeglądarkę, także z telefonu) jest niezawodne — po prostu zaznaczasz wszystkie pliki i przeciągasz je razem, bez ryzyka, że jakiś podfolder "zgubi się" po drodze.

## Struktura plików

```
index.html          — Strona główna
o-nas.html            — O nas
uslugi.html           — Usługi
realizacje.html       — Realizacje / galeria
kontakt.html          — Kontakt (dane + formularz + mapa)
style.css              — Cały styl strony (kolory, layout, responsywność)
script.js               — Menu mobilne, formularz kontaktowy (demo), rok w stopce
logo.svg                 — Logo (pełna wersja, odtworzone na podstawie przesłanej grafiki)
logo-mark.svg            — Sam znak graficzny (używany jako favicon)
hero-bg.svg               — Placeholder zdjęcia w sekcji hero
about-bg.svg              — Placeholder zdjęcia w sekcji "O nas"
realizacja-01.svg … realizacja-06.svg  — Placeholdery zdjęć realizacji (6 szt.)
```

## Dane, które są PRZYKŁADOWE — do podmiany

- Nazwa i dane firmy: **Aurelis Development**, ul. Budowlana 15, 30-001 Kraków
- Telefon: +48 123 456 789, e-mail: kontakt@aurelisdevelopment.pl, NIP: 000-000-00-00
- Wszystkie zdjęcia (hero, "o nas", 6 realizacji) — to grafiki-placeholdery z podpisem, do podmiany na prawdziwe fotografie
- Opinie klientów na stronie "Realizacje" — przykładowe, do zamiany na prawdziwe

## Jak podmienić zdjęcie

Podmień plik (np. `realizacja-01.svg`) na własne zdjęcie. Jeśli nowy plik ma inną nazwę lub rozszerzenie (np. `.jpg`), zaktualizuj też odpowiedni atrybut `src="..."` w pliku `.html`, w którym to zdjęcie jest użyte.

## Formularz kontaktowy

Formularz na stronie `kontakt.html` jest **demonstracyjny** — obecnie tylko pokazuje komunikat po stronie przeglądarki i nie wysyła maila. Aby zaczął realnie wysyłać wiadomości, najprościej podłączyć darmową usługę typu [Formspree](https://formspree.io) lub [EmailJS](https://www.emailjs.com) (podmiana `action` formularza w `kontakt.html`).

## Mapa

W sekcji kontaktowej użyto darmowej mapy OpenStreetMap (bez klucza API). Po ustaleniu prawdziwego adresu firmy, współrzędne w `kontakt.html` (`bbox` i `marker`) trzeba zaktualizować.

## Publikacja (GitHub Pages) — od zera

1. Na [github.com](https://github.com) usuń istniejące repozytorium `aurelis-development`, jeśli już próbowałaś je zakładać wcześniej (Settings repozytorium → na samym dole → Delete this repository), i utwórz je ponownie (przycisk **+** → **New repository** → nazwa `aurelis-development` → Create).
2. Na stronie nowego, pustego repozytorium kliknij **uploading an existing file**.
3. Zaznacz **wszystkie pliki** z tego folderu (na komputerze: Ctrl+A / Cmd+A) i przeciągnij je razem na stronę GitHuba.
4. Kliknij **Commit changes**.
5. Wejdź w **Settings** repozytorium → **Pages**, jako źródło ("Source") wybierz **Deploy from a branch**, branch **main**, folder **/ (root)** → **Save**.
6. Po 1–2 minutach strona będzie dostępna pod adresem `https://<twoja-nazwa-uzytkownika>.github.io/aurelis-development/`.

Docelowo można też podpiąć własną domenę (np. `aurelisdevelopment.pl`) w tych samych ustawieniach Pages.
