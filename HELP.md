# Chatbot Deployment with Flask and JavaScript

## Initial Setup:
for Login/Sign up- You first have to have XAMPP run the Apache and the XAMPP
for activation *** venv\Scripts\activate
Then run python app.py-to open up the flask interface

```
STEPS FOR SETTING UP
Install dependencies
```
$ (venv) pip install Flask torch torchvision nltk
```
Install nltk package
```
$ (venv) python
>>> import nltk
>>> nltk.download('punkt')

Run
```
$ (venv) python train.py
```
This will dump data.pth file. And then run
the following command to test it in the console.
```
$ (venv) python chat.py
```



