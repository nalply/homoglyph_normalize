#!/usr/bin/php
<?

# Convert the file confusables.txt (2016-06-16) from
# ftp://ftp.unicode.org/Public/security/latest/confusables.txt
# to a JavaScript object in which the first column is the key
# and the second column the value.

$confusables = file_get_contents('confusables.txt');

# Strip BOM
$bom = pack('H*','EFBBBF');
$confusables = preg_replace("/^$bom/", '', $confusables);

# Remove tab
$confusables = preg_replace('/\t/', ' ', $confusables);

# Remove comments
$confusables = preg_replace('/#[^\n]*\n/m', "\n", $confusables);

# Remove third column (MA)
$confusables = preg_replace('/; +MA/', '', $confusables);

# Convert a line <hex> ; <hex> <hex> to a mapping
$hex = '[0-9a-fA-F]+';
$confusables = preg_replace_callback("/^($hex) +;((?: +$hex)+)/m",
  function($matches) {
    $key = "\\u{{$matches[1]}}";
    $value = implode('}\u{', explode(' ', trim($matches[2])));
    return "'$key': '\u{{$value}}',\n";
  }, $confusables);

# Remove double newlines
$confusables = preg_replace('/\n([ ]*\n)+/m', "\n", $confusables);

echo "window.mapConfusables = {{$confusables}}\n";
