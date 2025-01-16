jQuery(document).ready(function ($) {
    let currentPlayer = 'X';
    let board = Array(9).fill(null);

    $('.xog-cell').on('click', function () {
        const cellIndex = $(this).data('cell');

        if (board[cellIndex] === null) {
            board[cellIndex] = currentPlayer;
            $(this).text(currentPlayer);

            if (checkWinner(board, currentPlayer)) {
                Swal.fire({
                    title: currentPlayer + ' ' + xog_data.win_message,
                    icon: 'success',
                    confirmButtonText: 'بازی جدید',
                }).then(() => {
                    resetBoard();
                });
            } else if (board.every(cell => cell !== null)) {
                Swal.fire({
                    title: xog_data.draw_message,
                    icon: 'info',
                    confirmButtonText: 'بازی جدید',
                }).then(() => {
                    resetBoard();
                });
            } else {
                currentPlayer = currentPlayer === 'X' ? 'O' : 'X';
            }
        }
    });

    function checkWinner(board, player) {
        const winningCombinations = [
            [0, 1, 2],
            [3, 4, 5],
            [6, 7, 8], // Rows
            [0, 3, 6],
            [1, 4, 7],
            [2, 5, 8], // Columns
            [0, 4, 8],
            [2, 4, 6] // Diagonals
        ];

        return winningCombinations.some(combination =>
            combination.every(index => board[index] === player)
        );
    }

    function handleGameEnd(result) {
        const playerWinner = result === 'draw' ? 'Draw' : result;

        Swal.fire({
            title: playerWinner === 'Draw' ? xog_data.draw_message : playerWinner + ' ' + xog_data.win_message,
            icon: playerWinner === 'Draw' ? 'info' : 'success',
            confirmButtonText: 'بازی جدید',
        }).then(() => {
            $.post(xog_data.ajax_url, {
                action: 'xog_save_result',
                player_winner: playerWinner,
            });

            resetBoard();
        });
    }


    function resetBoard() {
        board.fill(null);
        $('.xog-cell').text('');
    }
});