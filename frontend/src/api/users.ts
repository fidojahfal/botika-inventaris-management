import type { CreateUserPayload, User } from "../types/user";
import api from "./axios";

export const getUsers = async (): Promise<User[]> => {
  const res = await api.get("/users");

  return res.data.data;
};

export const createUser = async (payload: CreateUserPayload): Promise<User> => {
  const res = await api.post("/users/create", payload);
  console.log(res);
  return res.data.data;
};
