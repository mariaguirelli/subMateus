import axios from "axios";

export const axiosInstance = axios.create({
    baseURL: "http://localhost:8080"
})

export class ProfissaoService{

    listarTodos(){
        return axiosInstance.get("/profissao")
    }
}