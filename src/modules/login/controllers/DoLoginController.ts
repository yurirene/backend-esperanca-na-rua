import { Request, Response } from "express";
import { DoLoginUseCase } from "../useCases/DoLoginUseCase";

export class DoLoginController {
    async handle(req: Request, res: Response) {
        const doLoginUseCase = new DoLoginUseCase;
    }
}