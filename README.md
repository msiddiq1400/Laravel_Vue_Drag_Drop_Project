
## Deployment

To deploy this project run

```bash
  npm run install
```
```bash
  composer install
```

```bash
  php artisan serve
```

```bash
  npm run dev
```

once these commands ran successfully the project will be live on localhost:8000
where you can drag and drop the tasks/update/delete & add new tasks.


## Acknowledgements

usually when doing a laravel project its better to seperate all logic inside service files, and DB calls inside Repositories.
but here it was a single componenent and to make it quickly I used the controller for all the calls and skipped validations.
