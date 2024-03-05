<?php

// 1. Selezionare tutti gli studenti iscritti al corso di Laurea in Economia

SELECT `students`.*
FROM `students`
JOIN `degrees`
ON `students`.`degree_id` = `degrees`.`id`
WHERE `degrees`.`name` = "Corso di Laurea in Economia";

// 2. Selezionare tutti i Corsi di Laurea Magistrale del Dipartimento di Neuroscienze

SELECT `degrees`.* 
FROM `degrees`
JOIN `departments`
ON `degrees`.`department_id` = `departments`.`id`
WHERE `departments`.`name` = "Dipartimento di Neuroscienze"
AND `degrees`.`level`= "Magistrale";

// 3. Selezionare tutti i corsi in cui insegna Fulvio Amato (id=44)

SELECT `courses`.*, `teachers`.`name` as NomeInsegnante,`teachers`.`surname` as CognomeInsegnante
FROM `teachers`
JOIN `course_teacher`
ON `teachers`.`id` = `course_teacher`.`teacher_id`
JOIN `courses`
ON `courses`.`id` = `course_teacher`.`course_id`
WHERE `teachers`.`name` = "Fulvio"
AND `teachers`.`surname`= "Amato";

// 4. Selezionare tutti gli studenti con i dati relativi al corso di laurea a cui sono iscritti e il relativo dipartimento, in ordine alfabetico per cognome e nome

SELECT * 
FROM `students`
JOIN `degrees`
ON `degrees`.`id` = `students`.`degree_id`
JOIN `departments`
ON `degrees`.`department_id`= `departments`.`id`
ORDER BY `students`.`surname` , `students`.`name`;

// 5. Selezionare tutti i corsi di laurea con i relativi corsi e insegnanti

SELECT `degrees`.`name` as NomeLaurea, `courses`.`name` as NomeCorso, `teachers`.`name` AS NomeInsegnante, `teachers`.`surname`as CognomeInsegnante
FROM `degrees`
JOIN `courses`
ON `degrees`.`id` = `courses`.`degree_id`
JOIN `course_teacher`
ON `courses`.`id` = `course_teacher`.`course_id`
JOIN `teachers`
on `course_teacher`.`teacher_id` = `teachers`.`id`
ORDER BY `degrees`.`name`;

// 6. Selezionare tutti i docenti che insegnano nel Dipartimento di Matematica

SELECT DISTINCT `teachers`.*, `departments`.`name`
FROM `degrees`
JOIN `courses`
ON `degrees`.`id` = `courses`.`degree_id`
JOIN `course_teacher`
ON `courses`.`id` = `course_teacher`.`course_id`
JOIN `teachers`
on `course_teacher`.`teacher_id` = `teachers`.`id`
JOIN `departments`
on `degrees`.`department_id` = `departments`.`id`
WHERE `departments`.`name` = "Dipartimento di Matematica";

// 7. BONUS: Selezionare per ogni studente il numero di tentativi sostenuti per ogni esame, stampando anche il voto massimo. Successivamente, filtrare i tentativi con voto minimo 18

SELECT *
FROM (
    SELECT `students`.`name` as NomeStudente, `students`.`surname` as CognomeStudente, `courses`.`name` as NomeCorso, COUNT(`exams`.`id`) as NumeroAppelli, MAX(`exam_student`.`vote`) as VotoMassimo
    FROM `students`
    JOIN `exam_student`
    ON `students`.`id` = `exam_student`.`student_id`
    JOIN `exams`
    ON `exam_student`.`exam_id` = `exams`.`id`
    JOIN `courses`
    ON `courses`.`id` = `exams`.`course_id`

    GROUP BY NomeStudente, CognomeStudente, NomeCorso  
    ORDER BY `NomeStudente` ASC
	) as Filtered
WHERE Filtered.`VotoMassimo` >=18;



?>