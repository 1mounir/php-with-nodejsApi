const express = require('express');
const { route } = require('express/lib/application');
const router = express.Router();
const userController = require('../controllers/userController');
const verified = require('../routes/verify');
const { checkrole } = require('./checkrole');

// Routes


router.post('/login',userController.authentication);
router.get('/user',[verified.checkAuth,verified.checkRoles], userController.view);
router.delete('/user',[verified.checkAuth,verified.checkRoles], userController.delete);
router.get('/user/:id', [verified.checkAuth,verified.checkRoles],userController.getuser);
router.post('/user',/* [verified.checkAuth,verified.checkRoles],*/userController.create);
router.put('/user/:id',[verified.checkAuth,verified.checkRoles],userController.update);


  
module.exports = router;