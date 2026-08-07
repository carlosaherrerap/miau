import express from 'express';
import pg from 'pg';
import dotenv from 'dotenv/config';

const PORT=process.env.PORT || 3000;
const app=express();
const {Pool}=pg;

const pool=new Pool({
    user: process.env.POSTGRES_USER,
    password:process.env.POSTGRES_PASSWORD,
    port:process.env.DB_PORT,
    database:process.env.POSTGRES_DB
});

app.use(express.json());

app.get('/test-connection', async(req,res)=>{
    try{
        const result=await pool.query('SELECT NOW()');
        res.json({
            status:'Conexión Exitosa',
            time: result.rows[0].now,
            //un_usuario: result.rows[0]
        });
    } catch(error){
        console.error('Error al conectar a la DB', error);
        res.status(500).json({error: 'Error interno del Servidor'});
    }
});

app.get('/login',async (req,res)=>{
    try{
        
    } catch(error){

    }
});


app.listen(PORT,()=>{
    console.log(`Servidor corriendo en el puerto:${PORT}`);
});