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
  - Set TOKEN environment variable with your command's token
  - Set SHEET environment variable with your payroll google sheet

- Configure web as your docroot. This depends on what web server you are using.

### Heroku deployment

- Install the [Heroku Toolbelt](https://toolbelt.heroku.com/)
- [![Deploy to Heroku](https://www.herokucdn.com/deploy/button.png)](https://heroku.com/deploy)
- Set heroku environment variables

```bash
heroku config:add TOKEN="YOUR TOKEN" SHEET="URL to CSV SHEET"
```

- :thumbsup: