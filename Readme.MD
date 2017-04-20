# Map homoglyphs / homographs

Some glyphs look the same or are very similar. This is dangerous
as pointed out in 
http://hackaday.com/2017/04/19/you-think-you-cant-be-phished/

A solution (as least for internal software) would be a mapping of
homoglyphs to a default same-looking glyph.

I found the file confusables.txt in the Unicode Database, see:
ftp://ftp.unicode.org/Public/security/latest/confusables.txt
and wrote a small PHP script to convert it into a form usable
by JavaScript.
