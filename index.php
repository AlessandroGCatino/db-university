<?php

// QUERY CON SELECT

// 1. Selezionare tutti gli studenti nati nel 1990
SELECT *
FROM `students`
WHERE year(`date_of_birth`) = 1990;

// 2. Selezionare tutti i corsi che valgono più di 10 crediti

SELECT *
FROM `courses`
WHERE `cfu` > 10;

// 3. Selezionare tutti gli studenti che hanno più di 30 anni

SELECT *
FROM `students`
WHERE year(NOW()) - year(`date_of_birth`) > 30;

// 4. Selezionare tutti i corsi del primo semestre del primo anno si un qualsiasi corso di laurea

SELECT *
FROM `courses`
WHERE `period` = "I semestre" && `year` = 1;

// 5. Selezionare tutti gli appelli d'esame che avvengono nel pomeriggio (dopo le 14) del 20/06/2020

SELECT * 
FROM `exams`
WHERE hour(`hour`) >= 14 && `date` = "2020-06-20"

// 6. Selezionare tutti i corsi di laurea magistrale

SELECT * 
FROM `degrees`
WHERE `level` = "magistrale";

// 7. Da quanti dipartimenti è composta l'università?

SELECT COUNT("*")
FROM `departments`;

// 8. Quanti sono gli insegnanti che non hanno un numero di telefono?

SELECT COUNT("*") 
FROM `teachers` 
WHERE `phone`IS NOT null;


// QUERY CON GROUP BY

// 1. Contare quanti iscritti ci sono stati ogni anno

SELECT COUNT("*") as Iscrizioni, year(`enrolment_date`) as Anno
FROM `students`
GROUP BY Anno;

// 2. Contare gli insegnanti che hanno l'ufficio nello stesso edificio

SELECT COUNT("*") as Insegnanti, `office_address` as Edificio
FROM `teachers`
GROUP BY Edificio;

// 3. Calcolare la media dei voti di ogni appello d'esame

SELECT AVG(`vote`) as MediaVoto, `exam_id` as IDEsame
FROM `exam_student`
GROUP BY IDEsame;

// 4. Contare quanti corsi di laurea ci sono per ogni dipartimento

SELECT COUNT("*") as CorsiDiLaurea, `department_id` as Dipartimento
FROM `degrees`
GROUP BY Dipartimento;

?>
