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
  'token' => 'XEDLdo7T3QqUgsbZW8UInqUh',
  'sheet' => 'https://docs.google.com/spreadsheet/pub?key=15Z0F9Ee6uRH4-vD1v-FuXvMB-6laF4F_m5Gsr7fhsDM&single=true&gid=0&output=csv',
);
```

- Configure web as your docroot. This depends on what web server are you using.