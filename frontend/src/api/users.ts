import type { User } from "../types/user";
import api from "./axios";

export const getUsers = async (): Promise<User[]> => {
  const res = await api.get("/users");

  return res.data.data;
};
