import api from "./axios";

export const getInventaris = async () => {
  const res = await api.get("/inventaris");

  return res.data.data;
};
