PROGRAM HttpResponse(INPUT, OUTPUT);
USES
  SysUtils;
VAR
  RequestMethod, Query, ContentLength, User, Host: STRING;
BEGIN
  WRITELN('Content-Type: text/html');
  WRITELN;
  RequestMethod := GetEnv('REQUEST_METHOD');
  Query := GetEnv('QUERY_STRING');
  ContentLength := GetEnv('CONTETN_LENGTH');
  User := GetEnv('HTTP_USER_AGENT');
  Host := GetEnv('HTTP_HOST');
  
  WRITELN('<p><strong>REQUEST_METHOD:</strong> ', RequestMethod, '</p>');
  WRITELN('<p><strong>QUERY_STRING:</strong> ', Query, '</p>');
  WRITELN('<p><strong>CONTENT_LENGTH:</strong> ', ContentLength, '</p>');
  WRITELN('<p><strong>HTTP_USER_AGENT:</strong> ', User, '</p>');
  WRITELN('<p><strong>HTTP_HOST:</strong> ', Host, '</p>');
END.
