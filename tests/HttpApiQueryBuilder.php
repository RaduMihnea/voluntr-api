<?php


class HttpApiQueryBuilder
{
    private array $includes;

    private array $appends;

    private array $sorts;

    private ?int $pageValue;

    private ?int $limitValue;

    private array $payload;

    private array $filters;

    private ?string $cursorValue;

    public function __construct()
    {
        $this->includes = [];
        $this->appends = [];
        $this->sorts = [];
        $this->pageValue = null;
        $this->limitValue = null;
        $this->cursorValue = null;
        $this->payload = [];

        $this->filters = [];
    }

    public function filters(array $filters)
    {
        $this->filters = $filters;

        return $this;
    }

    public function include(...$relationships)
    {
        $relationships = is_array($relationships[0]) ? $relationships[0] : $relationships;
        $this->includes = $relationships;

        return $this;
    }

    public function append(...$attributes)
    {
        $attributes = is_array($attributes[0]) ? $attributes[0] : $attributes;
        $this->appends = $attributes;

        return $this;
    }

    public function orderBy(...$fields)
    {
        $fields = is_array($fields[0]) ? $fields[0] : $fields;
        $this->sorts = $fields;

        return $this;
    }

    public function page(int $value)
    {
        $this->pageValue = $value;

        return $this;
    }

    public function limit(int $value)
    {
        $this->limitValue = $value;

        return $this;
    }

    public function cursor(string $value)
    {
        $this->cursorValue = $value;

        return $this;
    }

    public function params(array $payload)
    {
        $this->payload = $payload;

        return $this;
    }

    public function queryData()
    {
        $data = [];

        if (count($this->filters)) {
            $data['filter'] = $this->filters;
        }

        if (count($this->includes)) {
            $data['include'] = implode(',', $this->includes);
        }

        if (count($this->appends)) {
            $data['append'] = implode(',', $this->appends);
        }

        if (count($this->sorts)) {
            $data['sort'] = implode(',', $this->sorts);
        }

        if ($this->pageValue) {
            $data['page'] = $this->pageValue;
        }

        if ($this->limitValue) {
            $data['per_page'] = $this->limitValue;
        }

        if ($this->cursorValue) {
            $data['cursor'] = $this->cursorValue;
        }

        if (count($this->payload)) {
            $data = array_merge($data, $this->payload);
        }

        return $data;
    }

    public function __toString()
    {
        return http_build_query($this->queryData());
    }
}
