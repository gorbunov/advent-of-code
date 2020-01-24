<?php declare(strict_types=1);


namespace Painting\Robot;


use IntCode\Program;
use Painting\Hull\Hull;
use Painting\Hull\Panel;
use IntCode\IntCodeRunner;

final class PainterRobot
{
    /**
     * @var Hull
     */
    private $hull;
    /**
     * @var IntCodeRunner
     */
    private $runner;
    /**
     * @var Position
     */
    private $position;

    private function __construct(Program $program, Hull $hull)
    {
        $this->runner = IntCodeRunner::fromProgram($program);
        $this->position = Position::create(0, 0);
        $this->hull = $hull;
    }

    public static function create(string $program): PainterRobot
    {
        $hull = Hull::create();
        return new self(Program::createFromArray(explode(',', $program)), $hull);
    }

    public function input(): Program\Input
    {
        return $this->runner->program()->input();
    }

    public function hull(): Hull
    {
        return $this->hull;
    }

    public function paint(): self
    {
        do {
            $panel_color = $this->readCurrentColor();
            $this->runner->program()->input()->insert($panel_color);
            if ($this->runner->untilOutput()) {
                break;
            }
            $color = $this->output()->pop();
            if ($this->runner->untilOutput()) {
                break;
            }
            $turn = $this->output()->pop();
            printf("ITER: ");
            print_array_values([$color, $turn]);
            $this->paintCurrentPanel($color);
            $this->move($turn);
            printf("Robot at %s, looking %s, painted: %d\n", $this->position, $this->orientation(), $color);
            echo "\n";
        } while (!$this->runner->halted());
        return $this;
    }

    private function readCurrentColor(): int
    {
        return $this->hull->panel($this->position->x(), $this->position->y())->color();
    }

    public function output(): Program\Output
    {
        return $this->runner->program()->output();
    }

    private function paintCurrentPanel(int $color): self
    {
        $this->currentPanel()->paint($color);
        return $this;
    }

    private function currentPanel(): Panel
    {
        return $this->hull->panel($this->position->x(), $this->position->y());
    }

    public function move(int $signal): self
    {
        $this->position->turn(self::turnDirection($signal));
        $this->position->forward();
        return $this;
    }

    public static function turnDirection(int $output): string
    {
        return $output === 0 ? Orientation::LEFT : Orientation::RIGHT;
    }

    public function orientation(): string
    {
        return $this->position->orientation();
    }

}
