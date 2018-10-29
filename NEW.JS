var express = require('express');
var app = express();
var MongoClient = require('mongodb').MongoClient;

var url = "mongodb://lakhan:lakhan@ds245615.mlab.com:45615/edb122";
var cookieParser = require('cookie-parser');
var session = require('express-session');
app.use(cookieParser());
app.use(session({secret: "Shh, its a secret!"}));
app.use(express.static('Desktop/edb'));
app.get('/form_again',function(req,res)
{
    res.sendFile(__dirname +"/"+"form_again.html");
});
app.get('/get_pro',function(req,res)
{
    req.session.user="hello";
    req.session.user=req.query.userid;
    req.session.password=req.query.passid;
    req.session.email=req.query.user_email;
    req.session.fname=req.query.Fname;
    req.session.Lname=req.query.Lname;
    res.send("done");

    MongoClient.connect(url, function(err, db) {
        if (err) throw err;

        db.collection("user").insertOne({username:req.query.userid,password:req.query.passid,email:req.query.user_email,fnmae:req.query.Fname,lname:req.query.Lname },function(err,res)
        {
            if(err) throw err;
            console.log("done");
            db.close();
        });
    });

    res.send("Thank you "+req.session.username+" you have successfully created account");
});





app.get('/index',function(req,res)
{
    res.sendFile(_dirname+"/"+"index.html");
});

app.get('/pro_get1',function(req,res)
{



    MongoClient.connect(url, function(err, db) {
        if (err) throw err;

        db.collection("user").findOne({username:req.query.userid,password:req.query.passid},function(err,result){
            if(req.query.username==result.username && req.query.password==result.password)
            {
                console.log("logged in");
                res.redirect('after Login.html');
            }
            else
            {
                console.log("login failed");
                res.send("failed");

            }
            db.close();
        });
    });});



app.get('/book new ticket.html',function(req,res)
{
    res.sendfile(__dirname+"/"+"book new ticket.html");
});


app.get('/pro_get4',function(req,res)
{

    req.session.from=req.query.user_job;

    MongoClient.connect(url, function(err, db) {
        if (err) throw err;
        db.collection("user").insertOne({username:req.query.userid,password:req.query.passid},function(err,res)
        {
            if(err) throw err;
            console.log("done");
            db.close();
        });
    });

    if(err) throw err;
    console.log("done");
    res.send('Welcome to job opportunities');

    db.close();
});








app.get('/pro_get2',function(req,res)
{
    if(req.session.from=='null')
    {
        res.send('no ticket has been booked');
    }
    else
    {

        res.send("from:" + " " + req.session.from + "\n" + "to:" + " " + req.session.to + "\n" + " date " +" " + req.session.date);
    }
});


app.listen(8081,'127.0.0.1');