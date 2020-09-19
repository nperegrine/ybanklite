/**
 * Define Transaction interface
 */
export default interface Transaction {
  id: number;
  from: number;
  to: number;
  details: string;
  amount: string;
}
