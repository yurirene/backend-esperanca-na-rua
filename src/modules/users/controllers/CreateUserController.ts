import { Request, Response } from "express";
import { CreateUserUseCase } from "../useCases/CreateUserUseCase";

export class CreateUserContoller {
    async handle(req: Request, res: Response) {
        const createUserUseCase = new CreateUserUseCase();
    }
}