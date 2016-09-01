## Point person
This is an slack slash command to look up for the person with the skills / knowgledge to answer your burning questions.

### Configuration
- Create a new slack slash command
- Create a sheet with at least this columns

```
name
slack
tags
```

- Publish it to the web going to File > Publish to the web...

- Configure your app
```
cp web
cp config.demo.php config.php
vim config.php
```

- Replace token with your branded new token command. 
- Replace sheet with your payroll google sheet.

```
$config = array(
  'token' => '***REMOVED***',
  'sheet' => '***REMOVED***',
);
```

- Configure web as your docroot. This depends on what web server are you using.