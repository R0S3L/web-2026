PROGRAM Hello(INPUT, OUTPUT);
USES
  DOS;
VAR
  Name: STRING;
BEGIN
  WRITELN('Content-Type: text/html');
  WRITELN;
  Name := GetEnv('QUERY_STRING');
  IF Name = ''
  THEN
    Name := Anonymous;
  WRITELN('Hello dear,' Name)
END.
