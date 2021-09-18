import * as React from 'react';
import Table from '@material-ui/core/Table';
import TableBody from '@material-ui/core/TableBody';
import TableCell from '@material-ui/core/TableCell';
import TableHead from '@material-ui/core/TableHead';
import TableRow from '@material-ui/core/TableRow';
import Title from './Title';
import { Link } from '@inertiajs/inertia-react';

export default function Reports({reports}) {
  return (
    <React.Fragment>
      <Title>Reports</Title>
      <Table size="small">
        <TableHead>
          <TableRow>
            <TableCell>ID</TableCell>
            <TableCell>Titulo</TableCell>
            <TableCell>URL</TableCell>
            <TableCell>Resumo</TableCell>
          </TableRow>
        </TableHead>
        <TableBody>
          {reports && reports.data.map((row) => (
            <TableRow key={row.id}>
              <TableCell>{row.external_id}</TableCell>
              <TableCell>{row.title}</TableCell>
              <TableCell>{row.url}</TableCell>
              <TableCell>{row.summary}</TableCell>
            </TableRow>
          ))}
        </TableBody>
      </Table>
      <Link href={reports.prev_page_url}>{reports && reports.prev_page_url && "Anterior"}</Link>
      <Link href={reports.next_page_url}>{reports && reports.next_page_url && "Próximo"}</Link>
    </React.Fragment>
  );
}
