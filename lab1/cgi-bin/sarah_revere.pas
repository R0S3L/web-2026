PROGRAM SarahRevere(INPUT, OUTPUT);
USES
  DOS;
VAR
  QueryString : STRING;
BEGIN
  WRITELN('Content-Type: text/html');
  WRITELN;
  QueryString := GetEnv('QUERY_STRING');
  IF QueryString = 'lanterns=1'
  THEN
    WRITELN('<p>British are coming by land!</p>')
  ELSE IF QueryString = 'lanterns=2'
  THEN
    WRITELN('<p>British are coming by sea!</p>')
  ELSE
    WRITELN('<p>Sarah didn''t say</p>')
END.

