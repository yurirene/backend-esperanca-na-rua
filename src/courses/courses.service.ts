import { Injectable } from '@nestjs/common';
import { CreateCourseDTO } from './dto/create-course.dto';
import { Couse } from './entities/course.entity';

@Injectable()
export class CoursesService {
    private courses: Couse[] = [
        {
            id: 1,
            name: 'Fundamentos 1',
            description: "Fundamento descricao",
            tags: ['node.js', 'nest.js', 'javascript']
        }
    ];

    findAll() {
        return this.courses;
    }

    findOne(id : string) {
        return this.courses.find((course) => {
            return course.id == Number(id);
        });
    }

    create(createCourseDTO : any) {
        this.courses.push(createCourseDTO);
    }

    update(id: string, updateCourseDTO : any) {
        const indexCourse = this.courses.findIndex(
            (course) => course.id == Number(id)
        );
        this.courses[indexCourse] = updateCourseDTO;
    }

    remove(id : string) {
        const indexCourse = this.courses.findIndex(
            (course) => course.id == Number(id)
        );
        this.courses.splice(indexCourse, 1);
    }
 }
