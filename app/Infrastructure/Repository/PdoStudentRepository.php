<?php

namespace App\Infrastructure\Repository;

use App\Infrastructure\Persistence\ConnectionCreator;
use App\Modelos\Phone;
use App\Modelos\Student;
use App\Repository\StudentRepository;
use PDO;

class PdoStudentRepository implements StudentRepository
{
    private \PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function allStudents(): array
    {
        $sqlQuery = 'SELECT * FROM students';
        $stmt = $this->connection->query($sqlQuery);

        return $this->hydrateStudentList($stmt);
    }

    public function studentsBirthAt(\DateTimeInterface $birthDate): array
    {
        $sqlQuery = 'SELECT * FROM students WHERE birth_date = ?;';
        $stmt = $this->connection->prepare($sqlQuery);
        $stmt->bindValue(1, $birthDate->format('Y-m-d'));
        $stmt->execute();

        return $this->hydrateStudentList($stmt);
    }

    private function hydrateStudentList(\PDOStatement $stmt): array
    {
        $studentDataList = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $studentList = [];

        foreach ($studentDataList as $studentData) {
            $studentList[] = new Student(
                $studentData['id'],
                $studentData['name'],
                new \DateTimeImmutable($studentData['birth_date']),
            );
        }

        return $studentList;
    }

    public function save(Student $student): bool
    {
        if ($student->id() === null) {
            return $this->insert($student);
        }

        return $this->update($student);
    }

    public function insert(Student $student): bool
    {
        $insertQuery = 'INSERT INTO students (name, birth_date) VALUES (:name, :birth_date);';
        $stmt = $this->connection->prepare($insertQuery);

        $success = $stmt->execute([
            ':name' => $student->name(),
            ':birth_date' => $student->birthDate()->format('Y-m-d'),
        ]);

        if ($success) {
            $student->defineId($this->connection->lastInsertId());
        }

        return $success;
    }

    public function update(Student $student): bool
    {
        $updateQuery = 'UPDATE students SET name = :name, birth_date = :birth_date WHERE id = :id;';
        $stmt = $this->connection->prepare($updateQuery);
        $stmt->bindValue(':name', $student->name());
        $stmt->bindValue(':birth_date', $student->birthDate()->format('Y-m-d'));
        $stmt->bindValue(':id', $student->id(), PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function remove(Student $student): bool
    {
        $statement = $this->connection->prepare("DELETE FROM students WHERE id = ?;");
        $statement->bindValue(1, $student->id());

        if ($statement->execute()) {
            echo "Aluno deletado!";
            return true;
        }
        return false;
    }

    public function find($id): ?Student
    {
        $findStudent = $this->connection->query("SELECT * FROM students WHERE id = ?;");
        $findStudent->bindValue(1, $id);
        $findStudent->execute();
        $foundStudent = $findStudent->fetch(\PDO::FETCH_ASSOC);
//        print_r($findedStudent['id']);
        if (!$foundStudent) {
            return null;
        }
//        var_dump($findedStudent); exit();
        return new Student(
            $foundStudent['id'],
            $foundStudent['name'],
            new \DateTimeImmutable($foundStudent['birth_date']),
        );
    }

    public function studentsWithPhones(): array
    {
        $sqlQuery = "SELECT students.id, students.name, students.birth_date, phones.id as phone_id, phones.area_code, phones.number 
        FROM students JOIN phones ON students.id = phones.student_id;";
        $stmt = $this->connection->query($sqlQuery);
        $result = $stmt->fetchAll();
        $studentList = [];

        foreach ($result as $row) {
            if (!array_key_exists($row['id'], $studentList)) {
                $studentList[$row['id']] = new Student(
                    $row['id'],
                    $row['name'],
                    new \DateTimeImmutable($row['birth_date'])
                );
            }
            $phone = New Phone($row['phone_id'], $row['area_code'], $row['number']);
            $studentList[$row['id']]->addPhone($phone);
        }

        return $studentList;
    }
}
