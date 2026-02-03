import type { CreateUserPayload, UpdateUserPayload, User } from "../types/user";
import api from "./axios";

export const getUsers = async (): Promise<User[]> => {
  const res = await api.get("/users");

  return res.data.data;
};

export const createUser = async (payload: CreateUserPayload): Promise<User> => {
  const res = await api.post("/users/create", payload);
  
  return res.data.data;
};

export const updateUser = async (
  id: number,
  payload: UpdateUserPayload,
): Promise<User> => {
  const res = await api.put(`/users/${id}`, payload);
  return res.data.data;
};

export const deleteUser = async (id: number): Promise<string> => {
  const res = await api.delete(`/users/${id}`);
  return res.data.message;
};
