import { useState, useEffect } from "react";
import axios from "axios";

export default function Profissoes() {
  const [profissoes, setProfissoes] = useState([]);
  const [form, setForm] = useState({
    id: null,
    nome: "",
    descricao: "",
    salario: "",
    empresa: "",
  });
  const [message, setMessage] = useState(null);

  const apiUrl = process.env.NEXT_PUBLIC_API_URL || "http://127.0.0.1:3000/api/profissoes";

  // Carregar as profissões
  useEffect(() => {
    fetchProfissoes();
  }, []);

  const fetchProfissoes = async () => {
    try {
      const response = await axios.get(`${apiUrl}/profissoes`);
      setProfissoes(response.data);
    } catch (error) {
      console.error("Erro ao buscar profissões:", error);
    }
  };

  const handleChange = (e) => {
    setForm({ ...form, [e.target.name]: e.target.value });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      if (form.id) {
        // Atualizar profissão
        await axios.put(`${apiUrl}/profissoes/${form.id}`, form);
        setMessage("Profissão atualizada com sucesso!");
      } else {
        // Criar nova profissão
        await axios.post(`${apiUrl}/profissoes`, form);
        setMessage("Profissão criada com sucesso!");
      }
      setForm({ id: null, nome: "", descricao: "", salario: "", empresa: "" });
      fetchProfissoes();
    } catch (error) {
      console.error("Erro ao salvar profissão:", error);
      setMessage("Erro ao salvar profissão.");
    }
  };

  const handleEdit = (profissao) => {
    setForm(profissao);
  };

  const handleDelete = async (id) => {
    try {
      await axios.delete(`${apiUrl}/profissoes/${id}`);
      setMessage("Profissão excluída com sucesso!");
      fetchProfissoes();
    } catch (error) {
      console.error("Erro ao excluir profissão:", error);
      setMessage("Erro ao excluir profissão.");
    }
  };

  return (
    <div style={{ padding: "20px", maxWidth: "800px", margin: "auto" }}>
      <h1>Gerenciamento de Profissões</h1>

      {message && <p style={{ color: "green" }}>{message}</p>}

      {/* Formulário de Cadastro/Atualização */}
      <form onSubmit={handleSubmit} style={{ marginBottom: "20px" }}>
        <h2>{form.id ? "Editar Profissão" : "Cadastrar Nova Profissão"}</h2>
        <div>
          <label>Nome:</label>
          <input
            type="text"
            name="nome"
            value={form.nome}
            onChange={handleChange}
            required
          />
        </div>
        <div>
          <label>Descrição:</label>
          <textarea
            name="descricao"
            value={form.descricao}
            onChange={handleChange}
            required
          />
        </div>
        <div>
          <label>Salário:</label>
          <input
            type="number"
            name="salario"
            value={form.salario}
            onChange={handleChange}
            required
          />
        </div>
        <div>
          <label>Empresa:</label>
          <input
            type="text"
            name="empresa"
            value={form.empresa}
            onChange={handleChange}
            required
          />
        </div>
        <button type="submit" style={{ marginTop: "10px" }}>
          {form.id ? "Atualizar" : "Cadastrar"}
        </button>
      </form>

      {/* Listagem de Profissões */}
      <h2>Lista de Profissões</h2>
      <table border="1" style={{ width: "100%", borderCollapse: "collapse" }}>
        <thead>
          <tr>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Salário</th>
            <th>Empresa</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          {profissoes.map((profissao) => (
            <tr key={profissao.id}>
              <td>{profissao.nome}</td>
              <td>{profissao.descricao}</td>
              <td>{profissao.salario}</td>
              <td>{profissao.empresa}</td>
              <td>
                <button onClick={() => handleEdit(profissao)}>Editar</button>
                <button
                  onClick={() => handleDelete(profissao.id)}
                  style={{ marginLeft: "10px" }}
                >
                  Excluir
                </button>
              </td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
}
